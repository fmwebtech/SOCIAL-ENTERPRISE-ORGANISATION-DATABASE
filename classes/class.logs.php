<?php

require_once('settings\connectionsetting.php');
class LOGS
{

    var $id;
    var $user; //camel casing
    var $computer;
    var $class;
    var $function;
    var $data;
    var $regDate;

    function __construct($id=NULL)
	{
		if($id!=NULL)
        {
		
		
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM logs WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->user= $v['USER'];
				$this->computer = $v['COMPUTER'];
				$this->class = $v['CLASS'];
				$this->function = $v['FUNCTION'];
				$this->data = $v['DATA'];
                $this->regDate = $v['REGDATE'];
			}
		}
	}

function save($user, $computer, $class, $function,$data)
 {
    try
     {
        global $Myconnection;
        $stmt = $Myconnection->prepare('INSERT INTO logs( [USER], [COMPUTER], [CLASS], [FUNCTION],[DATA]) 
                                        VALUES (?, ?, ?, ?, ?)');
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $computer);
        $stmt->bindParam(3, $class);
        $stmt->bindParam(4, $function);
        $stmt->bindParam(5, $data);
        $stmt->execute();
        return true;
    } 
    catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
	function getLogs()
	{
		try
        {
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM logs ');
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$logs = new LOGS();
				$logs->id = $v['ID'];
                $logs->user= $v['USER'];
				$logs->computer = $v['COMPUTER'];
				$logs->class = $v['CLASS'];			
				$logs->function = $v['FUNCTION'];
				$logs->data = $v['DATA'];
                $logs->regDate = $v['REGDATE'];
				$logsArray[] =$logs;
			}
			return $logsArray;
		}
        catch(Exception $e)
		{
			return false;
		}
	}


    function getLogsByUser($user)
	{
		try
        {
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM logs WHERE USER=? ');
            $stmt->bindParam(1,$user);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$logs = new LOGS();
				$logs->id = $v['ID'];
                $logs->user= $v['USER'];
				$logs->computer = $v['COMPUTER'];
				$logs->class = $v['CLASS'];			
				$logs->function = $v['FUNCTION'];
				$logs->data = $v['DATA'];
                $logs->regDate = $v['REGDATE'];
				$logsArray[] =$logs;
			}
			return $logsArray;
		}
        catch(Exception $e)
		{
			return false;
		}
	}


    function getLogsByClass($class)
	{
		try
		{
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM logs WHERE CLASS=? ');
            $stmt->bindParam(1,$class);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$logs = new LOGS();
				$logs->id = $v['ID'];
                $logs->user= $v['USER'];
				$logs->computer = $v['COMPUTER'];
				$logs->class = $v['CLASS'];			
				$logs->function = $v['FUNCTION'];
				$logs->data = $v['DATA'];
                $logs->regDate = $v['REGDATE'];
				$logsArray[] =$logs;
			}
			return $logsArray;
		}
        catch(Exception $e)
		{
			return false;
		}
	}

    function getLogsByClassAndFunction($class,$function)
	{
		try
        {
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM logs WHERE CLASS=? AND [FUNCTION]= ? ');
            $stmt->bindParam(1,$class);
            $stmt->bindParam(2,$function);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$logs = new LOGS();
				$logs->id = $v['ID'];
                $logs->user= $v['USER'];
				$logs->computer = $v['COMPUTER'];
				$logs->class = $v['CLASS'];			
				$logs->function = $v['FUNCTION'];
				$logs->data = $v['DATA'];
                $logs->regDate = $v['REGDATE'];
				$logsArray[] =$logs;
			}
			return $logsArray;
		}
        catch(Exception $e)
		{
			return false;
		}
	}

    function getLogsByDateRange($startDate,$endDate)
	{
		try
        {
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM logs WHERE CAST(REGDATE AS DATE) >= ? AND CAST(REGDATE AS DATE) <= ? ');
            $stmt->bindParam(1,$startDate);
            $stmt->bindParam(2,$endDate);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$logs = new LOGS();
				$logs->id = $v['ID'];
                $logs->user= $v['USER'];
				$logs->computer = $v['COMPUTER'];
				$logs->class = $v['CLASS'];			
				$logs->function = $v['FUNCTION'];
				$logs->data = $v['DATA'];
                $logs->regDate = $v['REGDATE'];
				$logsArray[] =$logs;
			}
			return $logsArray;
		}
        catch(Exception $e)
		{
			return false;
		}
	}

   

}

?>
