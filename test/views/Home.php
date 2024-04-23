<?php
$title = "Home";

include_once __DIR__ . '\Layout\header.php';

include '../app/models/User.php';
include '../app/requests/Validation.php';

$usersList = new User;
$usersListResut = $usersList->read(); // get all users


?>

<div class="container mt-4 shadow p-4">
    <div class="row">
        <div class="col">
        <a href="CreateUser.php" class="btn btn-primary">Create New User</a>
        </div>
        <div class="col">
            <h3 class="text-primary">Users</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">user_name</th>
      <th scope="col">city</th>
      <th scope="col">gender</th>
      <th scope="col">message</th>
      <th scope="col">status</th>
      <th scope="col">created at</th>
      <th scope="col">updated at</th>
      <th scope="col">actions</th>

    </tr>
  </thead>
  <tbody>
    <?php
    if($usersListResut){
        $users = $usersListResut->fetch_all(MYSQLI_ASSOC);
        foreach ($users as $index => $user) {
            ?>
           <tr>
    <td><?=$user['user_name'] ?></td>
    <td><?=$user['city'] ?></td>
    <td><?=$user['gender'] ?></td>
    <td><?=$user['message'] ?></td>
    <td class="text-<?=$user['status'] == 1?'success':'danger'?>"><?=$user['status']==1?'verified':'not verified' ?></td>
    <td><?=$user['created_at'] ?></td>
    <td><?=$user['updated_at'] ?></td>
    <td>
        <a href="UpdateUser.php?id=<?=$user['id']?>" class="btn btn-sm btn-warning">Update</a>
        <a href="../app/posts/deletePost.php?id=<?=$user['id']?>" class="btn btn-sm btn-danger">Delete</a>
    </td>

</tr>
<?php 
    }
}
    ?>




  </tbody>
</table>

        </div>
    </div>
</div>

    
<?php
include_once __DIR__ . '\Layout\footer.php';
?>