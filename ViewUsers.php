<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            /* margin: 50px; */
            font-family: Verdana, sans-serif;
            font-size: 18px;
            vertical-align: middle;
        }
        table, th, td {
            border: 1px solid black;
            margin: 0px auto;
            width: 20%;
            text-align: center;
        }
        button {
            align-items: flex-start;
            background-color: #fa8816;
            border-radius: 20px;
            border-style: solid;
            color: #ffffff;
            font-family: -apple-system;
            font-size: 20px;
            line-height: 30px;
            padding: 8px 16px;
            text-align: right;
        }
        a {
            text-decoration: none; 
        }
    </style>
    <title>View Usera</title>
</head>
<body>
    <button style="border-radius: 0px; background-color:grey;"><a style="color: white;" href="AdminHome.html">Admin Home</a></button> 
    <h1>Exercise 5: View Users</h1>
    <h2>The table displays all users.</h2>
    <?php
        $user_id = $_POST['username'];
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "Ait3vahs", "m449n496");
        if($mysqli -> connect_errno){
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        else{
            $query = "SELECT user_id from Users";
            if ($result = $mysqli->query($query)) {
                /* fetch associative array */
                echo "<table><tr><th>ID</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["user_id"]. "</td></tr>";  
                }
                echo "</table>";    
                /* free result set */
                $result->free();
            }                
        }
        $mysqli->close();        
    ?>   
    
</body>
</html>