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
<h1>Dashboard</h1>
<h2>User information</h2>
<a href="/api/edit-personal-data">Edit User information</a>
<a href="/api/get-users-list">Users list</a>
<?php
foreach ($user as $prop => $value) {
    if ($prop !== 'password') {
        ?>
        <div id="<?php echo $prop ?>">My <?php echo $prop ?> is : <b><?php if ($prop === 'field_id') {
                    echo $field['name'];
                } else {
                    echo $value;
                } ?></b></div>
    <?php }
} ?>

</body>
</html>