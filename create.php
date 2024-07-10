<?php 
    require_once "dbcon.php";

    if(isset($_POST["create"])){
        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $age = $_POST["age"];

        if($con){
            $sql = "INSERT INTO user (last_name, first_name, age) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
        
            if($stmt){
               mysqli_stmt_bind_param($stmt, "sss", $lastname, $firstname, $age);
               $result = mysqli_stmt_execute($stmt);
               mysqli_stmt_close($stmt);

               if($result){
                    echo '<script>alert("Account Created Successfully"); window.location.href="index.php"</script>';
               }else{
                echo '<script>alert("Account Failed to Create"); window.location.href="index.php"</script>';
               }
            }else{
                echo '<script>alert("Cant Insert Data to the DB"); window.location.href="index.php"</script>';
            }
        }else{
            echo '<script>alert("Didnt connect to db"); window.location.href="index.php"</script>';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HOME PAGE</title>
    </head>
    <body>
        <h2>WELCOME TO CREATE PAGE</h2>
        
        <form action="create.php" method="post">
            <input type="text" name="lastname" placeholder="Enter Last Name" id="" required><br><br>
            <input type="text" name="firstname" placeholder="Enter First Name" id="" required><br><br>
            <input type="number" name="age" placeholder="Enter Age" id="" required><br><br>

            <input type="submit" value="create" name="create">
            <button type="button" onclick="window.location.href='index.php'">cancel</button>
        </form>
    </body>
</html>     