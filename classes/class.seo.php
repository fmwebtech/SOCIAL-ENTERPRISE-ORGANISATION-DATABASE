<?php
require_once('settings\connectionsetting.php');
require_once('classes\class.logs.php');
class SEO
{
    var $id;
    var $name;
    var $established;
    var $ownership;
    var $primaryCountry;
    var $governance;
    var $hqCountry;
    
    var $countryFounded;
    var $incomePerAnnum;
    var $expenditurePerAnnum;
    var $createdBy;
    var $modifiedBy;
    var $status;
    var $regDate;

    function __construct($id = NULL)
    {
        if ($id != NULL)
         {


            // do nothing
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v)
             {
                $this->id = $v['ID'];
                $this->name = $v['NAME'];
                $this->established = $v['ESTABLISHED'];
                $this->ownership = $v['OWERNERSHIP'];
                $this->primaryCountry = $v['PRIMARYCOUNTRY'];
                $this->governance = $v['GOVERNANCE'];
                $this->hqCountry = $v['HQCOUNTRY'];
                $this->countryFounded = $v['COUNTRYFOUNDED'];
                $this->incomePerAnnum = $v['INCOMEPERANNUM'];
                $this->createdBy = $v['CREATED_BY'];
                $this->modifiedBy = $v['MODIFIED_BY'];
                $this->expenditurePerAnnum = $v['EXPENDITUREPERANNUM'];
                $this->status = $v['STATUS'];
                $this->regDate = $v['REGDATE'];
            }                
    }
}
    function save($name,$governance,$incomePerAnnum,$primaryCountry, $expenditurePerAnnum, $countryFounded, $established, $hqCountry,$createdBy,$ownership)
     {
        if ($this->seoExists($name))
        {
            echo 'The name you chose is already taken, choose a different name';

            return false;
        } 
       
        try
        {
            global $Myconnection;
            $stmt = $Myconnection->prepare("INSERT INTO  SEO ( [NAME],GOVERNANCE,INCOMEPERANNUM, PRIMARYCOUNTRY, EXPENDITUREPERANNUM, COUNTRYFOUNDED, ESTABLISHED, HQCOUNTRY,CREATED_BY,[OWERNERSHIP], STATUS) 
                                            VALUES (?,?, ?, ?, ?, ?, ?, ?,?,?,'new')");
             $stmt->bindParam(1, $name);
             $stmt->bindParam(2, $governance);
             $stmt->bindParam(3, $incomePerAnnum);
             $stmt->bindParam(4, $primaryCountry);
             $stmt->bindParam(5, $expenditurePerAnnum);
             $stmt->bindParam(6, $countryFounded);
             $stmt->bindParam(7, $established);
             $stmt->bindParam(8, $hqCountry);
             $stmt->bindParam(9, $createdBy);
             $stmt->bindParam(10,$ownership);
             $stmt->execute();
             (new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'SEO','SAVE',json_encode($_POST));
            return true;
            

        } catch (Exception $e)
         {

            echo $e->getMessage();
            return false;
        }
    }
    //new code to check the existance of the parameter passed above
    function seoExists($name)
    {
		try
        {
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM SEO WHERE NAME=?');
			$stmt->bindParam(1,$name);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				return true;
			}
			return false;

		}
        catch(Exception $e)
		{
			return true;
		}
	}

    function edit($id, $name, $established, $ownership,$primaryCountry, $modifiedBy, $governance, $hqCountry, $countryFounded, $incomePerAnnum, $expenditurePerAnnum, $status='edited') {
        
        if (!$this->safeToEdit($id, $name)) 
        {
            echo 'The name you chose is already taken, choose a different name.';
            return false;
        }
      
        try
         {
            global $Myconnection;
            $stmt = $Myconnection->prepare('UPDATE SEO SET [NAME]= ?,GOVERNANCE=?,INCOMEPERANNUM=?, PRIMARYCOUNTRY=?, EXPENDITUREPERANNUM=?, COUNTRYFOUNDED=?, ESTABLISHED=?, HQCOUNTRY=?,MODIFIED_BY=?, [STATUS]=? WHERE ID=?');
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $governance);
            $stmt->bindParam(3, $incomePerAnnum);
            $stmt->bindParam(4, $primaryCountry);
            $stmt->bindParam(5, $expenditurePerAnnum);
            $stmt->bindParam(6, $countryFounded);
            $stmt->bindParam(7, $established);
            $stmt->bindParam(8, $hqCountry);
            $stmt->bindParam(9, $modifiedBy);
            $stmt->bindParam(10,$status);
            $stmt->bindParam(11, $id);
            $stmt->execute();
             (new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'SEO','EDIT',json_encode($_POST));
            return true;
           

        }
         catch (Exception $e)

         {
            echo $e->getMessage();

            return false;
            

        }
    }

    function safeToEdit($Id,$name)
    {
		try
        {
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM SEO WHERE [NAME]=? AND ID !=?');
            $stmt->bindParam(1,$name);
			$stmt->bindParam(2,$Id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
                echo 'It is not safe to edit';
				return false;
               
			}
			return true;
		}
        catch(Exception $e)
		{
			return false;
		}
	}
	

    function getSeo() 
    {
        try 
        {
            $seoArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v)
             {
                $seo = new SEO();
                $seo->id = $v['ID'];
                $seo->name = $v['NAME'];
                $seo->established = $v['ESTABLISHED'];
                $seo->ownership = $v['OWERNERSHIP'];
                $seo->primaryCountry = $v['PRIMARYCOUNTRY'];
                $seo->governance = $v['GOVERNANCE'];
                $seo->hqCountry = $v['HQCOUNTRY'];
                $seo->countryFounded = $v['COUNTRYFOUNDED'];
                $seo->incomePerAnnum = $v['INCOMEPERANNUM'];
                $seo->expenditurePerAnnum = $v['EXPENDITUREPERANNUM'];
                $seo->createdBy = $v['CREATED_BY'];
                $seo->modifiedBy= $v['MODIFIED_BY'];
                $seo->status = $v['STATUS'];
                $seo->regDate = $v['REGDATE'];
                $seoArray[] = $seo;
            }
            return $seoArray;
        } catch (Exception $e) 
        {
            return false;
        }
    }

    function delete($id) 
    {
        try
         {
            global $Myconnection;
            $stmt = $Myconnection->prepare('DELETE FROM SEO WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            (new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'SEO','DELETE',json_encode($_POST));
            return true;
            

        }
         catch (Exception $e)
         {
            if(strpos($e->getMessage(),'statement conflicted'))
				{
				
				echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
							<div class="card-body text-danger">
								<strong>Oh snap!</strong> 
								
								This Company can not be deleted at the moment. Because the Company is attached to other system records. 
							
							</div>
						</div>';
				}
            return false;
        }
    }
}
?>
