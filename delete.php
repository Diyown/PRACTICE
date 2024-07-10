<?php 
    require_once "dbcon.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    }

    if(isset($_POST["delete"])){
        $id = $_POST["id"];

        $sql = "DELETE FROM user WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $delete = mysqli_stmt_execute($stmt);

        if($delete){
            echo '<script>alert("Account Successfully deleted"); window.location.href="index.php"</script>';
        }else{
            echo '<script>alert("Account Failed To delete"); window.location.href="index.php"</script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h2>Delete User</h2>
    <?php if(isset($user)): ?>
        <form action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
           <h2>
            Are You Really Really <br>
            Want To Delete <?php echo $user["last_name"] . ", " . $user["first_name"] . "<br>" . "Who is " . $user["age"] . "years old?";?>
           </h2>

            <input type="submit" value="delete" name="delete">
            <button type="button" onclick="window.location.href='index.php'">cancel</button>
        </form>
    <?php else: ?>
        <p>NO RECORDS FOUND</p>
    <?php endif;?>
</body>
</html>