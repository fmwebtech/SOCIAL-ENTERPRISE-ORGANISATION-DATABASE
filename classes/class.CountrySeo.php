<?php
require_once('settings/connectionsetting.php');

class CountrySeo {
    var $id;
    var $seo_Id;
    var $country_Id;
    var $status;
    var $regDate;

    // Constructor function
    function __construct($id = NULL) {
        if ($id == NULL) {
            // do nothing
        } else {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM countrySeo WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $this->id = $v['ID'];
                $this->seo_Id = $v['SEO_ID'];
                $this->country_Id = $v['COUNTRY_ID'];
                $this->status = $v['STATUS'];
                $this->regDate = $v['REGDATE'];
            }
        }
    }

    function save($country_Id, $seo_Id) {
        if ($this->countrySeoExists($seo_Id)) {
            echo 'The seo_Id you chose is already taken, choose a different seo_Id.';
            return false;
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('INSERT INTO countrySeo(country_Id, seo_Id, STATUS) VALUES(?, ?, "new")');
            $stmt->bindParam(1, $country_Id);
            $stmt->bindParam(2, $seo_Id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function edit($id, $country_Id, $seo_Id, $status) {
        if ($this->safeToEdit($id, $seo_Id)) {
            echo 'The seo_Id you chose is already taken, choose a different seo_Id.';
            return false;
        } else {
            // do nothing
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('UPDATE countrySeo SET country_Id=?, seo_Id=?, STATUS=? WHERE ID=?');
            $stmt->bindParam(1, $country_Id);
            $stmt->bindParam(2, $seo_Id);
            $stmt->bindParam(3, $status);
            $stmt->bindParam(4, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function countrySeoExists($seo_Id) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM countrySeo WHERE seo_Id=?');
            $stmt->bindParam(1, $seo_Id);
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

    function safeToEdit($id, $seo_Id) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM countrySeo WHERE seo_Id=? AND ID<>?');
            $stmt->bindParam(1, $seo_Id);
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

    function getCountrySeo($country_Id) {
        try {
            $countrySeoArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM countrySeo WHERE country_Id=?');
            $stmt->bindParam(1, $country_Id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $countrySeo = new CountrySeo();
                $countrySeo->id = $v['ID'];
                $countrySeo->country_Id = $v['country_Id'];
                $countrySeo->seo_Id = $v['seo_Id'];
                $countrySeo->status = $v['STATUS'];
                $countrySeo->regDate = $v['REGDATE'];
                $countrySeoArray[] = $countrySeo;
            }
            return $countrySeoArray;
        } catch (Exception $e) {
            return false;
        }
    }

    function delete($id) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('DELETE FROM countrySeo WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
