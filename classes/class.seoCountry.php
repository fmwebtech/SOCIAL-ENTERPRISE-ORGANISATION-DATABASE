<?php
require_once('settings/connectionsetting.php');

class SEO_COUNTRY {
    var $id;
    var $seoId;
    var $countryId;
    var $status;
    var $regDate;

    // Constructor function
    function __construct($id = NULL) {
        if ($id == NULL) {
            // do nothing
        } else {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $this->id = $v['ID'];
                $this->seoId = $v['SEO_ID'];
                $this->countryId = $v['COUNTRY_ID'];
                $this->status = $v['STATUS'];
                $this->regDate = $v['REGDATE'];
            }
        }
    }

    function save($countryId, $seoId) {
        if ($this->seoCountryExists($seoId)) {
            echo 'The seoId you chose is already taken, choose a different seoId.';
            return false;
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('INSERT INTO SEO_COUNTRY (COUNTRY_ID, SEO_ID, STATUS) VALUES(?, ?, "new")');
            $stmt->bindParam(1, $countryId);
            $stmt->bindParam(2, $seoId);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function edit($id, $countryId, $seoId, $status) {
        if ($this->safeToEdit($id, $seoId)) {
            echo 'The seoId you chose is already taken, choose a different seoId.';
            return false;
        } else {
            // do nothing
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('UPDATE SEO_COUNTRY SET COUNTRY_ID=?, SEO_ID=?, STATUS=? WHERE ID=?');
            $stmt->bindParam(1, $countryId);
            $stmt->bindParam(2, $seoId);
            $stmt->bindParam(3, $status);
            $stmt->bindParam(4, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function seoCountryExists($seoId) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE SEO_ID=?');
            $stmt->bindParam(1, $seoId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return true;
        }
    }

    function safeToEdit($id, $seoId) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE SEO_ID=? AND ID<>?');
            $stmt->bindParam(1, $seoId);
            $stmt->bindParam(2, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getSeoCountry($countryId) {
        try {
            $seoCountryArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM SEO_COUNTRY WHERE COUNTRY_ID=?');
            $stmt->bindParam(1, $countryId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $seoCountry = new seoCountry();
                $seoCountry->id = $v['ID'];
                $seoCountry->countryId = $v['COUNTRY_ID'];
                $seoCountyr->seoId = $v['SEO_ID'];
                $seoCountry->status = $v['STATUS'];
                $seoCountry->regDate = $v['REGDATE'];
                $seoCountryArray[] = $seoCountry;
            }
            return $seoCountryArray;
        } catch (Exception $e) {
            return false;
        }
    }

    function delete($id) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('DELETE FROM SEO_COUNTRY WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
