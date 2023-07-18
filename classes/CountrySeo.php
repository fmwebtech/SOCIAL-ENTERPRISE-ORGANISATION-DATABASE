<?php
require_once('settings/connectionsetting.php');

class CountrySeo {
    var $id;
    var $Seo_Id;
    var $Country_Id;
    var $status;
    var $regDate;

    // Constructor function
    function __construct($id = NULL) {
        if ($id == NULL) {
            // do nothing
        } else {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM CountrySeo WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $this->id = $v['ID'];
                $this->Seo_Id = $v['SEO_ID'];
                $this->Country_Id = $v['COUNTRY_ID'];
                $this->status = $v['STATUS'];
                $this->regDate = $v['REGDATE'];
            }
        }
    }

    function save($Country_Id, $Seo_Id) {
        if ($this->CountrySeoExists($Seo_Id)) {
            echo 'The Seo_Id you chose is already taken, choose a different Seo_Id.';
            return false;
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('INSERT INTO CountrySeo(Country_Id, Seo_Id, STATUS) VALUES(?, ?, "new")');
            $stmt->bindParam(1, $Country_Id);
            $stmt->bindParam(2, $Seo_Id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function edit($id, $Country_Id, $Seo_Id, $status) {
        if ($this->safeToEdit($id, $Seo_Id)) {
            echo 'The Seo_Id you chose is already taken, choose a different Seo_Id.';
            return false;
        } else {
            // do nothing
        }
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('UPDATE CountrySeo SET Country_id=?, Seo_Id=?, STATUS=? WHERE ID=?');
            $stmt->bindParam(1, $Country_Id);
            $stmt->bindParam(2, $Seo_Id);
            $stmt->bindParam(3, $status);
            $stmt->bindParam(4, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function CountrySeoExists($Seo_Id) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM CountrySeo WHERE Seo_Id=?');
            $stmt->bindParam(1, $Seo_Id);
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

    function safeToEdit($id, $Seo_Id) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM CountrySeo WHERE Seo_Id=? AND ID<>?');
            $stmt->bindParam(1, $Seo_Id);
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

    function getCountrySeo($Country_Id) {
        try {
            $CountrySeoArray = array();
            global $Myconnection;
            $stmt = $Myconnection->prepare('SELECT * FROM CountrySeo WHERE Country_Id=?');
            $stmt->bindParam(1, $Country_Id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $k => $v) {
                $CountrySeo = new CountrySeo();
                $CountrySeo->id = $v['ID'];
                $CountrySeo->Country_Id = $v['Country_Id'];
                $CountrySeo->Seo_Id = $v['Seo_Id'];
                $CountrySeo->status = $v['STATUS'];
                $CountrySeo->regDate = $v['REGDATE'];
                $CountrySeoArray[] = $CountrySeo;
            }
            return $CountrySeoArray;
        } catch (Exception $e) {
            return false;
        }
    }

    function delete($id) {
        try {
            global $Myconnection;
            $stmt = $Myconnection->prepare('DELETE FROM CountrySeo WHERE ID=?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
