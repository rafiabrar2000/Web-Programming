<?php
    include("Function.php");
    $objSign_In = new Sign_in();

    if(isset($_POST['add_info'])){
        $return_message=$objSign_In->add_data($_POST);
    }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Sign In</title>
</head>
<body>
  <div class="container">
    <h1>Sign In</h1>
    <form class="form" action="" method="POST" enctype="multipart/form-data">
    <?php if(isset($return_message)){echo $return_message;}?>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="passcode">Passcode:</label>
      <input type="password" id="passcode" name="passcode" required>

      <label for="phone">Phone:</label>
      <input type="tel" id="phone" name="phone" required>

      <input type="submit" value="Sign In" name="add_info">
    </form>
  </div>
</body>
</html>