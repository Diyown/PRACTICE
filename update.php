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

    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $age = $_POST["age"];

        $sql = "UPDATE user SET last_name = ?, first_name = ?, age = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssii", $lastname, $firstname, $age, $id);
        $update = mysqli_stmt_execute($stmt);

        if($update){
            echo '<script>alert("Account Successfully Updated"); window.location.href="index.php"</script>';
        }else{
            echo '<script>alert("Account Faild To Update"); window.location.href="index.php"</script>';
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
    <h2>Update User</h2>
    <?php if(isset($user)): ?>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
            <input type="text" name="lastname" value="<?php echo $user["last_name"]; ?>" required><br><br>
            <input type="text" name="firstname" value="<?php echo $user["first_name"]; ?>" required><br><br>
            <input type="number" name="age" value="<?php echo $user["age"]; ?>" required><br><br>

            <input type="submit" value="update" name="update">
            <button type="button" onclick="window.location.href='index.php'">cancel</button>
        </form>
    <?php else: ?>
        <p>NO RECORDS FOUND</p>
    <?php endif;?>
</body>
</html>