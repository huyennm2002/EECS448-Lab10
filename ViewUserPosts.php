<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table, th, td {
            border: 1px solid black;
            margin: 0px auto;
            width: 50%;
        }
        button {
            align-items: flex-start;
            background-color: #fa8816;
            border-color: #fa8816;
            border-radius: 20px;
            border-style: solid;
            border-width: 1px;
            color: #ffffff;
            font-family: -apple-system;
            font-size: 20px;
            line-height: 20px;
            padding: 8px 16px;
            text-align: center;
            margin: 0px auto;
        }
        a {
            text-decoration: none; 
        }
    </style>
    <title>View User Post</title>
</head>
<body>
<button style="border-radius: 0px; background-color:grey;"><a style="color: white;" href="AdminHome.html">Admin Home</a></button> 
    <h1>Exercise 6: View User Posts</h1>
    <?php
        $user_id = $_POST['username'];
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "Ait3vahs", "m449n496");
        if($mysqli -> connect_errno){
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        else{
            $query = "SELECT content, post_id from Posts WHERE author_id='$user_id'";
            if ($result = $mysqli->query($query)) {
             
                
                /* fetch associative array */
                echo "<table><th>Post ID</th><th>Post content</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["post_id"]. "</td><td>" . $row["content"]. "</td></tr>";  
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