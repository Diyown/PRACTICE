<?php 
    require_once "dbcon.php";

    $sql = "SELECT * FROM user";
    $result = mysqli_query($con, $sql);

    if($result){
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
        $users = [];
        echo "cant retrieve data from database" . mysqli_error($con);
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
        <h2>WELCOME TO HOME PAGE</h2>

        <button type="button" onclick="window.location.href='create.php'">Create User</button>
        <button type="button" onclick="window.location.href='search.php'">Search User</button>
        <?php if(!empty($users)):?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
                <?php foreach($users as $user):?>
                    <tr>
                        <td><?php echo $user["id"];?></td>
                        <td><?php echo $user["last_name"];?></td>
                        <td><?php echo $user["first_name"];?></td>
                        <td><?php echo $user["age"];?></td>
                        <td>
                            <button type="button" onclick="window.location.href='update.php?id=<?php echo $user["id"]; ?>'">Update</button>
                            <button type="button" onclick="window.location.href='delete.php?id=<?php echo $user["id"]; ?>'">Delete</button>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        <?php else: ?>
            <p>NO RECORDS FOUND</p>
        <?php endif;?>
    </body>
</html>