<?php
require_once('settings/connectionsetting.php'); 

class CURRENCY 
{
    var $id;
    var $name;
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
                $this->name = $v['NAME'];
                $this->modifiedBy = $v['MODIFIED_BY'];
                $this->status = $v['STATUS'];
                $this->regDate = $v['REGDATE'];
            }
        }
    }

function save($name, $createdBy,)
{
    if ($this->currencyExists($name, $createdBy))
    {
        echo 'The name you chose is already taken, choose a different name.';
        return false;
    }

    try
{

    global $Myconnection;
    $stmt = $Myconnection->prepare("INSERT INTO CURRENCY([NAME], CREATED_BY, STATUS) VALUES (?, ?, 'new')");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $createdBy);
    $stmt->execute();
    return true;

    (new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'CURRENCY','SAVE',json_encode($_POST));
}
 catch (Exception $e)
  {
    echo $e->getMessage();
    return false;   
  }  
}
    function currencyExists($name, $createdBy)
     {
        try
         {
           global $Myconnection;
        $stmt = $Myconnection->prepare('SELECT * FROM CURRENCY WHERE [NAME]=? AND CREATED_BY=?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $createdBy);
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

     function edit($id, $name, $modifiedBy, $status)
    {
        if (!$this->safeToEdit($id, $name))
         {
             echo 'The name you chose is already taken, choose a different name.';
             return false;
        }

       try
        {
          global $Myconnection;
          $stmt = $Myconnection->prepare('UPDATE CURRENCY SET [NAME]=?,MODIFIED_BY=?, [STATUS]=? WHERE ID=?');
          $stmt->bindParam(1, $name);
          $stmt->bindParam(2, $modifiedBy);
          $stmt->bindParam(3, $status);
          $stmt->bindParam(4, $id);
          $stmt->execute();
          return true;
          (new LOGS())->edit($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'CURRENCY','EDIT',json_encode($_POST));

        }
        catch (Exception $e)
        {
            echo $e->getMessage();
          return false;
        }
    }

    function safeToEdit($id, $name)
    {
        try
        {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM CURRENCY WHERE [NAME]=? AND ID<>?');
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $id);
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
            return true;
            (new LOGS())->delete($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'CURRENCY','DELETE',json_encode($_POST));

        }
         catch (Exception $e)
         {
            return false;
        }
    }
}
?>
