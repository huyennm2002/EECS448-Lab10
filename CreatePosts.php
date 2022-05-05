<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Posts</title>
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
            line-height: 30px;
            padding: 8px 16px;
            text-align: right;
        }
        .noti {
            margin: 20px 60px;
            font-size: 30px;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <button style="border-radius: 0px; background-color:grey;"><a style="color: white;" href="index.html">Home Page</a></button>
    <br>
    <?php
        $user_id = $_POST['username'];
        $content = $_POST['post'];
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "Ait3vahs", "m449n496");
        // //if username is empty
        if($user_id == '') echo "Please submit your username.";
        else{
            if ($content == '') {
                printf("There are no posts to save. Please write your post.");
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
                if ($result->num_rows == 0) echo "User does not exist.";
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
    <button><a href='CreatePosts.html'>Create new Post</a></button>   
</body>
</html>