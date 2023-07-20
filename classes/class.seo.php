<?php
require_once('settings\connectionsetting.php');

class Seo {
    var $id;
    var $name;
    var $established;
    var $ownership;
    var $primaryCountry;
    var $governance;
    var $hqCountry;
    var $createdBy;
    var $countryFounded;
    var $incomePerAnnum;
    var $expenditurePerAnnum;
    var $modifiedBy;
    var $status;
    var $regDate;

    function __construct($id = NULL) {
        if ($id == NULL) {

            // do nothing
        } 
        else
         {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM Seo WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $this->id = $v['ID'];
                $this->name = $v['NAME'];
                $this->established = $v['ESTABLISHED'];
                $this->ownership = $v['OWNERSHIP'];
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
    function save($name, $established, $ownership,$primaryCountry, $governance, $hqCountry, $creaedBy, $countryFounded, $incomePerAnnum, $expenditurePerAnnum)
     {
        if ($this->SeoExists($name,$ownership)) {


            echo 'The name you chose is already taken, choose a different name';

            return false;
        } 
        else 
        {
            // do nothing
        }
        try
        {
            global $Myconnection;
            $stmt = $Myconnection->prepare('INSERT INTO user(NAME, ESTABLISHED, [OWNERSHIP], PRIMARYCOUNTRY, GOVERNANCE, HQCOUNTRY,CREATED_BY, COUNTRYFOUNDED, INCOMEPERANNUM, EXPENDITUREPERANNUM,STATUS) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?,?,?, ?,"new")');
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $established);
            $stmt->bindParam(3, $ownership);
            $stmt->bindParam(4, $primaryCountry);
            $stmt->bindParam(5, $governance);
            $stmt->bindParam(6, $hqCountry);
            $stmt->bindParam(7, $createdBy);
            $stmt->bindParam(8, $countryFounded);
            $stmt->bindParam(9, $incomePerAnnum);
            $stmt->bindParam(10, $expenditurePerAnnum);
            $stmt->execute();
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();
            return false;
        }
    }
    //new code to check the existance of the parameter passed above
    function SeoExists($name,$ownership){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM seo WHERE NAME=?AND OWNERSHIP=?');
			$stmt->bindParam(1,$name);
            $stmt->bindParam(2,$ownership);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				return true;
			}
			return false;
		}catch(Exception $e)
		{
			return true;
		}
	}

    function edit($id, $name, $established, $ownership,$primaryCountry, $modifiedBy, $governance, $hqCountry, $countryFounded, $incomePerAnnum, $expenditurePerAnnum, $status) {
        if ($this->safeToEdit($id, $name)) {
            echo 'The name you chose is already taken, choose a different name.';
            return false;
        } else {
            // do nothing
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('UPDATE SEO SET [NAME]= ?,[OWNERSHIP]=?,PRIMARYCOUNTRY=?, COUNTRYFOUNDED=?, GOVERNANCE=?, ESTABLISHED=?, EXPENDITUREPERANNU=?, MODIFIED_BY=?,INCOMEPERANNUM=?, HQCOUNTRY=?, [STATUS]=? WHERE ID=?');
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $governance);
            $stmt->bindParam(3, $incomePerAnnum);
            $stmt->bindParam(4, $primaryCountry);
            $stmt->bindParam(5, $expenditurePerAnnum);
            $stmt->bindParam(6, $countryFounded);
            $stmt->bindParam(7, $established);
            $stmt->bindParam(8, $hqCountry);
            $stmt->bindParam(9, $modifiedBy);
            $stmt->bindParam(10, $status);
            $stmt->bindParam(11, $id);
            $stmt->bindParam(12,$ownership);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    //NEW CODE FOR SafeEdit function

    function safeToEdit($id,$name){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM seo WHERE [NAME]=? AND ID<>?');
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				return false;
			}
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	

    function getSeo($name) {
        try {
            $SEOArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM Seo WHERE [NAME]=?');
            $stmt->bindParam(1, $name);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $seo = new Seo();
                $seo->id = $v['ID'];
                $seo->name = $v['NAME'];
                $seo->established = $v['ESTABLISHED'];
                $seo->ownership = $v['OWNERSHIP'];
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
        } catch (Exception $e) {
            return false;
        }
    }

    function delete($id) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('DELETE FROM SEO WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
