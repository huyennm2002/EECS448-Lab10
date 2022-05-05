<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <?php
        $user_id = $_POST['username'];
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "Ait3vahs", "m449n496");
        // //if username is empty
        if($user_id == '') echo "Please submit your username.";
        else{
            
            //check connection
            if ($mysqli->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                exit();
            }
            else{
                // Check if username has already existed.
                $query = "SELECT user_id FROM Users WHERE user_id='$user_id'";
                $mysqli->query($query);
                $result = $mysqli->query($query);              
                //Username is taken
                if ($result->num_rows > 0) echo "Username has already been taken.";
                // Username is not taken
                else{
                    // Insert username into Users table
                    $sql="INSERT INTO Users (user_id)  VALUES ('$user_id')";  
                    if ($mysqli->query($sql) === TRUE) {
                        echo "New user created successfully!";
                    } else {
                        echo "Error: " . $sql . "<br>" . $mysqli->error;
                    }
                }
                $mysqli -> close();
            }
        }
    ?>    
</body>
</html>