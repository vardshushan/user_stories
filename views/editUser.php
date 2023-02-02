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
<h1>Edit User</h1>
<form action="/api/user/update" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" value=<?php echo $user['name'] ?>> <br>

    <label for="surname">Surname:</label>
    <input type="text" name="surname" value=<?php echo $user['surname'] ?>> <br>

    <label for="password">Password:</label>
    <input type="password" name="password"> <br>

    <label for="position">Position:</label>
    <input type="text" name="position" value=<?php echo $user['position'] ?>> <br>

    <label for="type">Type:</label>
    <select name="type">
        <option value="mentor">Mentor</option>
        <option value="mentee">Mentee</option>
    </select>
    <br>
    <label for="description">A short description</label>
    <textarea name="description"><?php echo $user['description'] ?></textarea> <br>

    <label for="field_id">Field</label>
    <select name="field_id">
        <?php foreach ($fields as $field) { ?>
            <option <?php if ($field['id'] == $user['field_id']) echo 'selected'; ?>
                    value=<?php echo $field['id'] ?>><?php echo $field['name'] ?></option>
        <?php } ?>
    </select>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" value=<?php echo $user['email'] ?>> <br>

    <label for="education">Education:</label>
    <input type="text" name="education" value=<?php echo $user['education'] ?>> <br>

    <label for="experience">Experience:</label>
    <input type="number" name="experience" value=<?php echo $user['experience'] ?>> <br>

    <label for="about">About</label>
    <textarea name="about"><?php echo $user['about'] ?></textarea> <br>
    <input type="submit" name="register" value="submit">
</form>

</body>
</html>