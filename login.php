<?php
include 'config.php';

$message = [];
session_start();

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Get user by email
    $stmt = $connection->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (isset($user)) {
        if (password_verify($password, $user['password'])) {
            if ($user['type'] == 'user') {
                $_SESSION['name'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                header('Location: user/home.php');
                exit;
            } else  if ($user['type'] == 'admin') {
                $_SESSION['admin_name'] = $user['username'];
                $_SESSION['admin_email'] = $user['email'];
                $_SESSION['admin_id'] = $user['id'];
                header('Location: admin/admin_page.php');
                exit;
            }
        } else {
            $message[] = "Incorrect password.";
        }

    } else {
        $message[] = "User not found.";
    }
}
?>

 
 <!DOCTYPE html>
 <html>
    <head>
        <title> login </title>
        <link rel="stylesheet" href="C.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />   
    </head>
    <body>
        <?php if (!empty($message)) : ?>
            <div class="messages">
                <?php foreach ($message as $msg) : ?>
                    <div class="message">
                        <?= htmlspecialchars($msg) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

         <div class="login-wrapper">
  <div class="login-form">
    <form action="login.php" method="POST">
      <h1>Sign in</h1>
      <!-- <label for="Email">Email</label> -->
      <input type="email" name="email" placeholder="Email" required />
      <!-- <label for="pwd">Password</label> -->
      <input type="password" name="password" placeholder="Password" required />
      <a id="frgt" href="#">Forgot your password?</a>
      <button type="submit">Sign In</button>
    </form>
  </div>
  <div class="login-image">
    <img src="Hvgh.jpg" alt="Login Illustration">
  </div>
</div>
    </body>
 </html>