<?php
require_once('settings/connectionsetting.php'); 
require_once('classes\class.logs.php');

class CURRENCY 
{
    var $id;
    var $name;
    var $code;
    var $createdBy;
    var $modifiedBy;
    var $status;
    var $regDate;

    function __construct($id = NULL)
    {


        if ($id != NULL)
        {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM CURRENCY WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) 
            {
                $this->id = $v['ID'];
                $this->createdBy = $v['CREATED_BY'];
                $this->code = $v['CODE'];
                $this->name = $v['NAME'];
                $this->modifiedBy = $v['MODIFIED_BY'];
                $this->status = $v['STATUS'];
                $this->regDate = $v['REGDATE'];
            }
        }
    }

function save($name, $code, $createdBy,)
{
    if ($this->currencyExists($code))
    {
        echo 'The name you chose is already taken, choose a different name.';
        return false;
    }

    try
{

    global $Myconnection;
    $stmt = $Myconnection->prepare("INSERT INTO CURRENCY([NAME], [CODE], CREATED_BY, STATUS) VALUES (?, ?, ?, 'new')");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $code);
    $stmt->bindParam(3, $createdBy);
    $stmt->execute();
    (new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'CURRENCY','SAVE',json_encode($_POST));
    return true;

}
 catch (Exception $e)
  {
    echo $e->getMessage();
    return false;   
  }  
}
    function currencyExists( $code)
     {
        try
         {
           global $Myconnection;
        $stmt = $Myconnection->prepare('SELECT * FROM CURRENCY WHERE CODE=?');
        $stmt->bindParam(1, $code);
        $stmt->execute();         
        $stmt->setFetchMode(PDO::FETCH_ASSOC);         
        $results = $stmt->fetchAll();         
        foreach ($results as $k => $v) {
        return true;
            }
           return false;

         } 
         catch (Exception $e)
       {
            return true;
       }
     }

     function edit($id, $name, $code, $modifiedBy, $status='edited')
    {
        if (!$this->safeToEdit($code))
         {
             echo 'The name you chose is already taken, choose a different name.';
             return false;
        }

       try
        {
          global $Myconnection;
          $stmt = $Myconnection->prepare('UPDATE CURRENCY SET [NAME]=?, [CODE]=?, MODIFIED_BY=?, [STATUS]=? WHERE ID=?');
          $stmt->bindParam(1, $name);
          $stmt->bindParam(2, $code);
          $stmt->bindParam(3, $modifiedBy);
          $stmt->bindParam(4, $status);
          $stmt->bindParam(5, $id);
          $stmt->execute();
          (new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'CURRENCY','EDIT',json_encode($_POST));

          return true;

        }
        catch (Exception $e)
        {
            echo $e->getMessage();
          return false;
        }
    }

    function safeToEdit($code)
    {
        try
        {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM CURRENCY WHERE [CODE]=?');
            $stmt->bindParam(1, $code);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v)
             {
                return false;
            }
            return true;
        } catch (Exception $e)
        
        {
            return false;
        }
    }

    function getCurrency()
    {
        try
        {
            $CurrencyArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM CURRENCY ');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) 
            {
                $currency = new CURRENCY();
                $currency->id = $v['ID'];
                $currency->name = $v['NAME'];
                $currency->code = $v['CODE'];
                $currency->modifiedBy = $v['MODIFIED_BY'];
                $currency->createdBy = $v['CREATED_BY'];
                $currency->status = $v['STATUS'];
                $CurrencyArray[] = $currency; 
            }
            return $CurrencyArray;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    function delete($id)
    {
        try
        {
            global $Myconnection;
            $stmt = $Myconnection->prepare('DELETE FROM CURRENCY WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            (new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'CURRENCY','DELETE',json_encode($_POST));

            return true;

        }
         catch (Exception $e)
         {
            if(strpos($e->getMessage(),'statement conflicted'))
				{
				
				echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
							<div class="card-body text-danger">
								<strong>Oh snap!</strong> 
								
								This Currency can not be deleted at the moment. Because the currency is attached to other system records. 
							
							</div>
						</div>';
				}
            return false;
        }
    }
}
?>
