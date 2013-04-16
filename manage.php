<?php
// http://cz2.php.net/manual/en/pdostatement.fetchcolumn.php

$result = NULL;
$dbh = new PDO('mysql:host=localhost;dbname=test', 'root', 'atad');
if (!empty($_GET['row'])) {
    $sth = $dbh->prepare("SELECT * FROM contact WHERE id = ?");
    $sth->execute(array($_GET['row']));
    $result = $sth->fetch(PDO::FETCH_ASSOC);
}
?>
<form action="index.php" method="get">
    <table>
        <tbody>
            <tr>
                <td>
                    <input type="hidden" name="id" value="<?= (($result) ? $result["id"] : NULL); ?>" />
                    <input type="text" name="name" value="<?= (($result) ? $result["name"] : NULL); ?>" />
                </td>
                <td><input type="text" name="surname" value="<?= (($result) ? $result["surname"] : NULL); ?>"/></td>
                <td><input type="text" name="telefone" value="<?= (($result) ? $result["telefone"] : NULL); ?>"/></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td><input type="submit" name="insert" value="insert" /></td>
                <td><input type="submit" name="edit" value="edit" /></td>
                <td><input type="submit" name="delete" value="delete" /></td>
            </tr>
        </tfoot>
    </table>
</form>
<a href="index.php">Zpět</a>