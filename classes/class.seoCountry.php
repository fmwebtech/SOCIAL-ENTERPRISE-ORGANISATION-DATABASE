<?php
require_once('settings/connectionsetting.php');

class seoCountry
{
    var $id;
    var $seoId;
    var $countryId;
    var $status;
    var $regDate;

    // Constructor function
    function __construct($id = NULL)
     {
        if ($id == NULL) 
        {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v)
            {
                $this->id = $v['ID'];
                $this->seoId = $v['SEO_ID'];
                $this->countryId = $v['COUNTRY_ID'];
                $this->status = $v['STATUS'];
                $this->regDate = $v['REGDATE'];
            }
        }
    }

    function save($countryId, $seoId)
     {
        if ($this->seoCountryExists($seoId)) 
        {
            echo 'This Records Exist';
            return false;
        }
        try 
        {
            global $Myconnection;
            $stmt = $Myconnection->prepare("INSERT INTO SEO_COUNTRY (COUNTRY_ID, SEO_ID, STATUS) 
            VALUES(?, ?, 'new')");
            $stmt->bindParam(1, $countryId);
            $stmt->bindParam(2, $seoId);
            $stmt->execute();
            return true;
            (new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'seoCountry','SAVE',json_encode($_POST));

        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
            return false;
        }
    }

    function edit($id, $countryId, $seoId, $status, $modifiedBy)
     {
        if ($this->safeToEdit($id, $seoId, $countryId))
        {

            echo 'The Record exist';

            return false;
        } 
       
        try
         {
            global $Myconnection;
            $stmt = $Myconnection->prepare('UPDATE SEO_COUNTRY SET COUNTRY_ID=?, SEO_ID=?, STATUS=?, MODIFIED_BY=? WHERE ID=?');
            $stmt->bindParam(1, $countryId);
            $stmt->bindParam(2, $seoId);
            $stmt->bindParam(3, $status);
            $stmt->bindParam(4, $modifiedBy);
            $stmt->bindParam(5, $id);
            $stmt->execute();
            return true;
            (new LOGS())->edit($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'seoCountry','EDIT',json_encode($_POST));

        } catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    function seoCountryExists($seoId)
     {
        try
         {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE SEO_ID=?');
            $stmt->bindParam(1, $seoId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) 
            {
                return true;
            }
            return false;
        }
         catch (Exception $e) 
        {
            return true;
        }
    }

    function safeToEdit($id,$seoId,$countryId) 
    {
        try
         {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE SEO_ID=?, COUNTRY_ID=?, AND ID<>?');
            $stmt->bindParam(1,$seoId);
            $stmt->bindParam(2,$id);
            $stmt->bindParam(3,$countryId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v)
            {
                return false;
            }
            return true;
        } 
        catch (Exception $e)
        {
            return false;
        }
    }

    function getSeoCountryByCountryId($countryId)
     {
        try 
        {
            $seoCountryByIdArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE COUNTRY_ID=?');
            $stmt->bindParam(1, $countryId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) 
            {
                $seoCountry = new seoCountry();
                $seoCountry->id = $v['ID'];
                $seoCountry->countryId = $v['COUNTRY_ID'];
                $seoCountry->seoId = $v['SEO_ID'];
                $seoCountry->status = $v['STATUS'];
                $seoCountry->regDate = $v['REGDATE'];
                $seoCountryArray[] = $seoCountry;
            }
            return $seoCountryArray;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    function getSeoCountryBySeoId($seoId)
     {
        try 
        {
            $seoCountryArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE SEO_ID=?');
            $stmt->bindParam(1, $seoId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) 
            {
                $seoCountry = new seoCountry();
                $seoCountry->id = $v['ID'];
                $seoCountry->countryId = $v['COUNTRY_ID'];
                $seoCountry->seoId = $v['SEO_ID'];
                $seoCountry->status = $v['STATUS'];
                $seoCountry->regDate = $v['REGDATE'];
                $seoCountryArray[] = $seoCountry;
            }
            return $seoCountryArray;
        }
         catch (Exception $e)
        {
            return false;
        }
    }
    function getSeoCountryBySeoIdAndCountryId($seoId,$countryId)
     {
        try
         {
            $seoCountryArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE SEO_ID=? AND COUNTRY_ID=?');
            $stmt->bindParam(1, $seoId);
            $stmt->bindParam(2,$countryId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v)
            {
                $seoCountry = new seoCountry();
                $seoCountry->id = $v['ID'];
                $seoCountry->countryId = $v['COUNTRY_ID'];
                $seoCountry->seoId = $v['SEO_ID'];
                $seoCountry->status = $v['STATUS'];
                $seoCountry->regDate = $v['REGDATE'];
                $seoCountryArray[] = $seoCountry;
            }
            return $seoCountryArray;
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
            $stmt = $Myconnection->prepare('DELETE FROM SEO_COUNTRY WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return true;
            (new LOGS())->delet($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'seoCountry','DELETE',json_encode($_POST));

        }
         catch (Exception $e)
        {
            return false;
        }
    }
}
?>
