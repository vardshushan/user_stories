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
<h1>User Profile</h1>
<h2>User information</h2>
<?php
foreach (json_decode($userProfile) as $prop => $value) {
    if ($prop !== 'password') {
        ?>
        <div id="<?php echo $prop ?>"><?php if ($prop === 'field_id') {
                echo 'field';
            } else echo $prop; ?> is : <b><?php if ($prop === 'field_id') {
                    echo $field['name'];
                } else {
                    echo $value;
                } ?></b></div>
    <?php }
} ?>

</body>
</html>