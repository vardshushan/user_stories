<?php
include("header.php");
?>
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

<?php
include("footer.php");
?>