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
<h1>Register Page</h1>
<form action="api/auth/register" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name"> <br>

    <label for="surname">Surname:</label>
    <input type="text" name="surname"> <br>

    <label for="position">Position:</label>
    <input type="text" name="position"> <br>

    <label for="type">Type:</label>
    <select name="type">
        <option value="mentor">Mentor</option>
        <option value="mentee">Mentee</option>
    </select>
    <br>
    <label for="description">A short description</label>
    <textarea name="description" rows="4" cols="25" maxlength="255"></textarea> <br>

    <label for="field_id">Field</label>
    <select name="field_id">
        <?php foreach ($fields as $field) { ?>
            <option value=<?php echo $field['id'] ?>><?php echo $field['name'] ?></option>
        <?php } ?>
    </select>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email"> <br>

    <label for="password">Password:</label>
    <input type="password" name="password"> <br>

    <label for="education">Education:</label>
    <input type="text" name="education"> <br>

    <label for="experience">Experience:</label>
    <input type="number" name="experience"> <br>

    <label for="about">About</label>
    <textarea name="about" rows="4" cols="25" maxlength="255"></textarea> <br>
    <input type="submit" name="register" value="submit">
</form>
<a href="?login=true">Login</a>

</body>
</html>