<?php
$submitPressed = filter_input(INPUT_POST, "btnSubmit");
if ($submitPressed) {
    $name = filter_input(INPUT_POST, "txtCatName");
    $link = mysqli_connect("host", "username", "password", "dbname", "port") or die(mysqli_connect_error());
    $query = "INSERT INTO category(name) VALUES(?)";
    mysqli_autocommit($link, FALSE);
    if ($stmt = mysqli_prepare($link, $query)) {
        //  s for string, i for int, d for double, b for blob
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<form action="" method="post">
    <fieldset>
        <legend>Category Form</legend>
        <label for="idTxtCatName">Category name</label>
        <input id="idTxtCatName" name="txtCatName" type="text" autofocus="" placeholder="New Category Name" required="">
        <br>
        <input type="submit" name="btnSubmit" value="Submit Data">
    </fieldset>
</form>

<?php
$link = mysqli_connect("host", "username", "password", "dbname", "port") or die(mysqli_connect_error());
$query = "SELECT * FROM category";
if ($result = mysqli_query($link, $query)) {
    echo '<table id="tableId" class="display">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Name</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    mysqli_close($link);
}
?>