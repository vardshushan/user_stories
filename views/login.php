<?php
if (Token::authenticate()) {
    header("Location:/dashboard");
}
?>
<?php
include("header.php");
?>
<h1>Login Page</h1>

<form action="/api/auth/login" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <button name="login" type="submit" id="submit"> Submit</button>
</form>

<a href="register">Register</a>

<?php
include("footer.php");
?>

