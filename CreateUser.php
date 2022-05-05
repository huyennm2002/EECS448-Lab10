<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            font-size: 14px;
            align-items: center;
        }

        form {
            align-items: center;
            background-color: #ffffff;
            color: black;
            line-height: 24px;
            width: 50%;
            margin: 90px auto;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }
        .userInfo {
            background-color: #ffffff;
            border-color: #ced4da;
            border-radius: 4px 4px 0px 0px;
            border-style: solid;
            border-width: 1px;
            color: #495057;
            font-family: -apple-system;
            line-height: 24px;
            margin: 0px 0px -1px;
            padding: 10px;
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
            line-height: 30px;
            padding: 8px 16px;
            text-align: right;
        }

        .noti {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <button style="border-radius: 0px; background-color:grey;"><a style="color: white;" href="index.html">Home Page</a></button>
    <form class="form" action="CreateUser.php" method="POST">
        <div>
            <h2> Create New User </h2>
            <p></p>
            <div class="userInfo">
                <span></span>
                <label for="username">Username</label>
            <input type="text" name="username" value="" placeholder="Enter Username">
            </div>
            <br>
            
            <button type="submit">Submit</button>
        </div>
    </form>
    <?php
        $user_id = $_POST['username'];
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "Ait3vahs", "m449n496");
        // //if username is empty
        if($user_id == '') echo "<div class='noti'>Please submit your username.</div>";
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
                if ($result->num_rows > 0) echo "<div class='noti'>Username has already been taken.</div>";
                // Username is not taken
                else{
                    // Insert username into Users table
                    $sql="INSERT INTO Users (user_id)  VALUES ('$user_id')";  
                    if ($mysqli->query($sql) === TRUE) {
                        echo "<div class='noti'>New user created successfully!</div>";
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