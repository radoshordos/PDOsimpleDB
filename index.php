<?php
// http://cz2.php.net/manual/en/pdo.connections.php
// http://cz2.php.net/manual/en/pdostatement.execute.php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', 'atad');
    if (!empty($_GET['insert'])) {
        $sth = $dbh->prepare('INSERT INTO contact (name,surname,telefone) VALUES (:name,:surname,:telefone)');
        $sth->execute(array(':name' => $_GET['name'], ':surname' => $_GET['surname'], ':telefone' => $_GET['telefone']));
    } else if (!empty($_GET['edit'])) {
        $sth = $dbh->prepare('UPDATE contact SET name=:name,surname=:surname,telefone=:telefone WHERE id=:id');
        $sth->execute(array(':id' => $_GET['id'], ':name' => $_GET['name'], ':surname' => $_GET['surname'], ':telefone' => $_GET['telefone']));
    } else if (!empty($_GET['delete'])) {
        $sth = $dbh->prepare('DELETE FROM contact WHERE id=:id');
        $sth->execute(array(':id' => $_GET['id']));
    }
    ?>
    <table>
        <tbody>
            <?php foreach ($dbh->query('SELECT * FROM contact') as $row) { ?>
                <tr>
                    <td><a href="manage.php?row=<?= $row["id"]; ?>"><?= $row["id"]; ?></a></td>                    
                    <td><?= $row["name"]; ?></td>
                    <td><?= $row["surname"]; ?></td>
                    <td><?= $row["telefone"]; ?>"</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="manage.php">Přidat</a>
    <?php
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>