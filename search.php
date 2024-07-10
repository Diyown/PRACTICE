<?php 
    require_once "dbcon.php";

    $search_results = [];

    if(isset($_POST["search"])){
        $search = mysqli_real_escape_string($con, $_POST["search"]);
        $sql = "SELECT * FROM user WHERE last_name LIKE '%$search%' OR first_name LIKE '%$search%'";
        $result = mysqli_query($con, $sql);

        if($result){
            $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
            echo "Failed to Retrieve data";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search User</title>
</head>
<body>
    <h2>Search a User</h2>

    <form action="search.php" method="post">
        <input type="text" name="search" placeholder="search" required>
        <button type="submit">Search</button><br><br>
    </form>

    <?php if(!empty($search_results)):?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Age</th>
            </tr>

            <?php foreach($search_results as $user):?>
                <tr>
                    <td><?php echo $user["id"];?></td>
                    <td><?php echo $user["last_name"];?></td>
                    <td><?php echo $user["first_name"];?></td>
                    <td><?php echo $user["age"];?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php else:?>
            <p>NO RECORDS FOUND</p>
        <?php endif; ?>

</body>
</html>