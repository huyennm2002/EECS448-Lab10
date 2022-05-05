<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
            margin: 20px auto;
        }
        .noti {
            margin: 0px 60px;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<button style="border-radius: 0px; background-color:grey;"><a style="color: white;" href="AdminHome.html">Admin Home</a></button> 
    <h1>Exercise 7: Delete User Posts</h1>
    <?php
        $delete = $_POST['check_list'];
        $checked_count = count($_POST['check_list']);
        echo "<div class='noti'>You have deleted following ".$checked_count." post(s): </div><br/>";
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "Ait3vahs", "m449n496");
        if($mysqli -> connect_errno){
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        if(empty($delete)){
            echo "<br>";
            echo "<div class='noti'>";
            echo "<span> No posts were selected! </span>";
            echo "<br>";
            echo "<button><a href='DeletePost.html'>Delete Post</a></button>";
            echo "</div>";
        }

        else{
            foreach($delete as $id){
                $sql = "DELETE FROM Posts WHERE post_id = '$id'";
                if ($mysqli->query($sql) === TRUE) {
                    echo "<br>";
                    echo "<div 'noti'>";
                    echo "<span> Post with $id was deleted!</span>";
                    echo "<br>";
                    echo "</div>";
                } 
                else {
                    echo "Error deleting record: " . $mysqli->error;
                }
            }
            echo "<button><a href='DeletePost.html'>Delete Post</a></button>";
        }                
        
        $mysqli->close();
    ?>  
</body>
</html>
