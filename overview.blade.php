<?php
/**
 * Created by PhpStorm.
 * User: tl3m
 * Date: 11-06-18
 * Time: 13:09
 */

//require_once ('delete.blade.php');
?>
        <!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Overview</title>
</head>
<body>

<form method="post">

    <?php
    $stack = array();
    $user = 'root';
    $password = 'root';
    $pdo = null;
    $db = 'games';
    $game = new Game(0, 'Fifa 19', 'EA', 8);
   $selected = '';
    try {

        $pdo = new PDO("mysql:host=localhost;dbname=$db",
            $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->query('SELECT * FROM games');
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        while ($row = $statement->fetch()) {
            $game = new Game($row['id'], $row['Name'], $row['Developer'], $row['Score']);

            array_push($stack, $game);
        }
    } catch (PDOException $e) {
        print 'Exception!: ' . $e->getMessage();
    }
    $pdo = null;
    ?>
    <table class="gameTabel">

        <tr>
            <th>ID</th>
            <th>Game Naam</th>
            <th>Developer</th>
            <th>Score</th>
            <th>pas aan</th>
        </tr>
        <?php

        for ($x = 0; $x < count($stack); $x++) {
            echo ' <tr> ' . '<td>' .
                '<input type="number" name="id[' . $x . ']" value="' . $stack[$x]->id . '"/>' . '</td>' . '<td>' .
                '<input type="text" name="name[' . $x . ']" value="' . $stack[$x]->name . '"/>' . '</td>' . '<td>' .
                '<input type="text" name="Developer[' . $x . ']" value="' . $stack[$x]->lastName . '"/>' . '</td> ' . '<td>'.
                '<input type="text" name="score[' . $x . ']" value="' . $stack[$x]->nickName . '"/>' . '</td>'.
                '<td>' . '<input name="checkbox[' . $x . ']" type="checkbox">' . '</td>' . '</tr>'.
                '<input type="number" name="originalId[' . $x . ']" value="' . $stack[$x]->id . '" hidden />';
        }

        ?>
    </table>

    <br/><br/><input type="submit" name="verwijderButton" value="verwijder"/>
    <br/><br/> <input type="submit" formaction="games.blades.php" value="voeg toe"/>
    <br/>

</form>
</body>
</html>