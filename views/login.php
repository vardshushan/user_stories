<?php
if (Token::authenticate()) {
    header("Location:/dashboard");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Login Page</h1>

<form action="/api/auth/login" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <button name="login" type="submit" id="submit"> Submit</button>
</form>

<a href="?register=true">Register</a>

</body>
</html>




