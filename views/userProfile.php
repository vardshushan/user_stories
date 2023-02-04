<?php
include("header.php");
?>
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

<?php
include("footer.php");
?>