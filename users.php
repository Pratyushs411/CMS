<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
// if(isset($_SESSION['id'])){
//   header('Location: dashboard.php');
//   die();
// }
secure();
include('includes/header.php');
if(isset($_GET['delete'])){
    if ($stm = $connect->prepare('DELETE FROM users where id = ?')){
        $stm->bind_param('i',  $_GET['delete']);
        $stm->execute();
        

        set_message("A user " . $_GET['delete'] . " has beed deleted");
        header('Location: users.php');
        $stm->close();
        die();

    } else {
        echo 'Could not prepare statement!';
    }

}
//var_dump($_SESSION);
    if ($stm = $connect->prepare('SELECT * FROM users')) {
        $stm->execute();

        $result = $stm->get_result();
        if ($result->num_rows>0) {

            //give a feedback

        }
        ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h1 class="display-1">Users management</h1>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Edit | Delete</th>
                        </tr>
                        <?php while ($record = mysqli_fetch_assoc($result)) { ?>
                         <tr>
                            <td><?php echo $record['ID'];?></td>
                            <td><?php echo $record['Username'];?></td>
                            <td><?php echo $record['Email'];?></td>
                            <td><?php echo $record['Active'];?></td>
                            <td><a href="users_edit.php?id=<?php echo $record['ID'];?>">Edit</a> | 
                            <a href = "users.php?delete=<?php echo $record['ID'];?>">Delete</a></td>
                         </tr>
                         <?php } ?>
                    </table>
                    <a href="users_add.php">Add a new User</a>
                </div>
            </div>
        </div>


        <?php
    }
    else{
    echo 'No users found';}
    $stm->close();
include('includes/footer.php');
?>