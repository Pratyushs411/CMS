<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
if(isset($_SESSION['id'])){
  header('Location: dashboard.php');
  die();
}
include('includes/header.php');
if (isset($_POST['email'])) {
  if ($stm = $connect->prepare('SELECT * FROM users WHERE email = ? AND password = ? AND active = 1')){
      $hashed = SHA1($_POST['password']);
      $stm->bind_param('ss', $_POST['email'], $hashed);
      $stm->execute();

      $result = $stm->get_result();
      $user = $result->fetch_assoc();
// var_dump($user);
      if ($user){
          $_SESSION['id'] = $user['ID'];
          $_SESSION['email'] = $user['Email'];
          $_SESSION['username'] = $user['Username'];
//give a feedback
          set_message("You have succesfully logged in " . $_SESSION['username']);
          header('Location: dashboard.php');
          die();
      }
      $stm->close();

  } else {
      echo 'Could not prepare statement!';
  }
  }
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="post">
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" id="email" name="email" class="form-control" />
          <label class="form-label" for="email">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="password" name="password" class="form-control" />
          <label class="form-label" for="password">Password</label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
      </form>
    </div>
  </div>
</div>


<?php
include('includes/footer.php');
?>