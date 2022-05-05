<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
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
            border-radius: 10px;
            margin: 0px auto;
            width: 75%;
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
            font-size: 20px;
        }

        button {
            align-items: flex-start;
            background-color: #fa8816;
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
    <form class="form" action="CreatePosts.php" method="POST">
        <div>
            <h2> Create New Post </h2>
            <p></p>
            <div class="userInfo">
                <span></span>
                <label for="username">Username</label>
                <input type="text" name="username" value="" placeholder="Enter Username">
            </div>
            <div class="userInfo">
                <label for="post">Your post:</label>
                <br>
                <textarea style="width:75%; height: 400px;" name="post" value = "" placeholder="Write your post here"></textarea>
            </div>
            <br>
            <button type="submit">Submit</button>
        </div>
    </form>
    <br>
    <?php
        $user_id = $_POST['username'];
        $content = $_POST['post'];
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "Ait3vahs", "m449n496");
        // //if username is empty
        if($user_id == '') echo "<div class='noti'>Please submit your username.</div>";
        else{
            if ($content == '') {
                echo "<div class='noti'>There are no posts to save. Please write your post.</div>";
                exit();
            }
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
                if ($result->num_rows == 0) echo "<div class='noti'>User does not exist.</div>";
                // Username is not taken
                else{
                    // Insert username into Users table
                    $sql="INSERT INTO Posts (author_id, content)  VALUES ('$user_id','$content')";  
                    if ($mysqli->query($sql) === TRUE) {
                        echo "<div class='noti'>New post created successfully!</div>";
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