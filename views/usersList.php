<?php
include("header.php");
?>

<h1>Users List</h1>
<form action="/api/get-users-list" method="post">
    <label>
        <select name="search_type">
            <option value="name" <?php if ($_POST['search_type'] == 'name') echo 'selected'; ?>> Name</option>
            <option value="surname" <?php if ($_POST['search_type'] == 'surname') echo 'selected'; ?>> Surname</option>
            <option value="type" <?php if ($_POST['search_type'] == 'type') echo 'selected'; ?>> Type</option>
            <option value="registered_at" <?php if ($_POST['search_type'] == 'registered_at') echo 'selected'; ?>>
                Registered At
            </option>
        </select>
    </label>
    <label>
        <input type="search" name="search_value" value=<?php echo $_POST['search_value'] ?>>
    </label>
    <button type="submit" name="search"> Search</button>
</form>
<?php
foreach ($users as $key => $user) {
    $profileUrl = '/api/user/' . $user['id']; ?>
    <h1><?php echo $key + 1 ?> : </h1>
    <a href=<?php echo $profileUrl; ?>>Show Profile</a>
    <h3> Name: <?php echo $user['name'] ?></h3>
    <h3> Surname: <?php echo $user['surname'] ?></h3>
    <h3> Email: <?php echo $user['email'] ?></h3>
    <h3> Registered at: <?php echo $user['registered_at'] ?></h3>
    <h3> Type: <?php echo $user['type'] ?></h3>
    <br>
<?php } ?>
<?php
include("footer.php");
?>