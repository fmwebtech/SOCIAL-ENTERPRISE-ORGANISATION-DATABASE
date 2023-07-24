<html>
    <head>
<title>Log Form</title>
</head>
<body>

<h1>ADD Log</h1>



<form action="ajax.saveLogs.php" method="post">
    <label>User:</label>
    <input type="text" name="user" required placeholder="Enter user">
    <br>

    <label>computer:</label>
    <input type="text" name="computer" required placeholder="Enter computer">
    <br>

    <label>Class:</label>
    <input type="text" name="class" required placeholder="Enter class">
    <br>

    <label>Function:</label>
    <input type="text" name="function" required placeholder="Enter function">
    <br>
    <label>Data:</label>
    <input type="text" name="data" required placeholder="Enter data">
    <br>
    
    <button type="submit" name="mybutton">Add Log</button>
</form> 




<form action="ajax.getLogs.php" method="post">
    

    <label>Class:</label>
    <input type="text" name="class" required placeholder="Enter class">
    <br>

    <label>Function:</label>
    <input type="text" name="function" required placeholder="Enter function">
    <br>
    
    
    <button type="submit" name="mybutton">Get Log</button>
</form> 


<form action="ajax.getLogs.php" method="post">
    

    <label>Class:</label>
    <input type="text" name="class" required placeholder="Enter class">
    <br>


    
    <button type="submit" name="mybutton">Get Log</button>
</form> 




<form action="ajax.getLogs.php" method="post">
    <label>User:</label>
    <input type="text" name="user" required placeholder="Enter user">
    <br>

    
    <button type="submit" name="mybutton">Get Log</button>
</form> 


<form action="ajax.getLogs.php" method="post">
    
    <label>Start Date:</label>
    <input type="date" name="startDate" required placeholder="Enter data">
    <br>
    <label>End Date:</label>
    <input type="date" name="endDate" required placeholder="Enter data">
    <br>
    
    <button type="submit" name="mybutton">Get Log</button>
</form> 


<form action="ajax.getLogs.php" method="post">
  
    
    <button type="submit" name="mybutton">Get Log</button>
</form> 




















</body>
</html>





