<?php
$userDao = new UserDaoImpl();
$signInPressed = filter_input(INPUT_POST, 'btnSignIn');
if ($signInPressed) {
    $username = filter_input(INPUT_POST, 'txtUsername');
    $password = filter_input(INPUT_POST, 'txtPassword');
    $md5Password = md5($password);
    $user = new User();
    $user->setUsername($username);
    $user->setPassword($md5Password);
    $result = $userDao->login($user);
    if ($result != null && $result->getUsername() == $username) {
        $_SESSION['my_session'] = true;
        $_SESSION['session_user'] = $result->getName();
        header("location:index.php");
    } else {
        echo '<div class="bg-danger">Invalid username or password</div>';
    }
}
?>

<form method="post" class="form-sign-in">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="Username" class="sr-only">Username</label>
    <input type="text" id="txtUsername" name="txtUsername" autofocus required placehoder="Username" class="form-control">
    <label for="Password" class="sr-only">Password</label>
    <input type="text" id="txtPassword" name="txtPassword" autofocus required placehoder="Password" class="form-control">
    <input type="submit" class="btn -btn-lg btn-primary btn-block" value="sign-in" name="btnSignIn">
    <a href="register.php" class="btn btn-success">Daftar</a>
</form>
