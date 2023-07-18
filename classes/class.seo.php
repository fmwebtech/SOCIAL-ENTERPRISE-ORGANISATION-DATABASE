<?php
require_once('settings/connetionsetting.php');

class SEO {
    var $id;
    var $name;
    var $established;
    var $ownership;
    var $governance;
    var $hqcountry;
    var $countryfounded;
    var $incomeperannum;
    var $expenditureperannum;
    var $status;
    var $regDate;

    function __construct($id = NULL) {
        if ($id == NULL) {
            // do nothing
        } else {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $this->id = $v['ID'];
                $this->name = $v['NAME'];
                $this->established = $v['ESTABLISHED'];
                $this->ownership = $v['OWNERSHIP'];
                $this->governance = $v['GOVERNANCE'];
                $this->hqcountry = $v['HQCOUNTRY'];
                $this->countryfounded = $v['COUNTRYFOUNDED'];
                $this->incomeperannum = $v['INCOMEPERANNUM'];
                $this->expenditureperannum = $v['EXPENDITUREPERANNUM'];
                $this->status = $v['STATUS'];
                $this->regDate = $v['REGDATE'];
            }
        }
    }

    function save($id, $name, $established, $ownership, $governance, $hqcountry, $countryfounded, $incomeperannum, $expenditureperannum) {
        if ($this->idExists($id)) {
            echo 'The username you chose is already taken, choose a different username.';
            return false;
        } else {
            // do nothing
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('INSERT INTO user(ID, NAME, ESTABLISHED, OWNERSHIP, GOVERNANCE, HQCOUNTRY, COUNTRYFOUNDED, INCOMEPERANNUM, EXPENDITUREPERANNUM, REGDATE, STATUS) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "new")');
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $name);
            $stmt->bindParam(3, $established);
            $stmt->bindParam(4, $ownership);
            $stmt->bindParam(5, $governance);
            $stmt->bindParam(6, $hqcountry);
            $stmt->bindParam(7, $countryfounded);
            $stmt->bindParam(8, $incomeperannum);
            $stmt->bindParam(9, $expenditureperannum);
            $stmt->bindParam(10, $regDate);
            $stmt->bindParam(11, $status);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function edit($id, $name, $established, $ownership, $governance, $hqcountry, $countryfounded, $incomeperannum, $expenditureperannum) {
        if ($this->safeToEdit($id, $name)) {
            echo 'The username you chose is already taken, choose a different username.';
            return false;
        } else {
            // do nothing
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('UPDATE user SET USERNAME=?, TYPE=?, FIRST_NAME=?, LAST_NAME=?, GRADE=?, GENDER=?, DATE_OF_BIRTH=?, STATUS=? WHERE ID=?');
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $governance);
            $stmt->bindParam(3, $incomeperannum);
            $stmt->bindParam(4, $expenditureperannum);
            $stmt->bindParam(5, $countryfounded);
            $stmt->bindParam(6, $established);
            $stmt->bindParam(7, $hqcountry);
            $stmt->bindParam(8, $regDate);
            $stmt->bindParam(9, $status);
            $stmt->bindParam(10, $id);
            $stmt->bindParam(11, $ownership);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getUsers($type) {
        try {
            $SEOArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO WHERE TYPE=?');
            $stmt->bindParam(1, $type);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $seo = new SEO();
                $seo->id = $v['ID'];
                $seo->name = $v['NAME'];
                $seo->established = $v['ESTABLISHED'];
                $seo->ownership = $v['OWNERSHIP'];
                $seo->governance = $v['GOVERNANCE'];
                $seo->hqcountry = $v['HQCOUNTRY'];
                $seo->countryfounded = $v['COUNTRYFOUNDED'];
                $seo->incomeperannum = $v['INCOMEPERANNUM'];
                $seo->expenditureperannum = $v['EXPENDITUREPERANNUM'];
                $seo->status = $v['STATUS'];
                $seo->regDate = $v['REGDATE'];
                $seoArray[] = $seo;
            }
            return $SEOArray;
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
