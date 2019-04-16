<?php


if (isset($_POST)) {
    if (isset($_POST["addButton"])) {
        $user = 'root';
        $password = 'root';
        $database = 'games';
        $pdo = null;
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$database",
                $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            $statement = $pdo->prepare('INSERT INTO games ' .
                '(Name, Developer, Score) VALUES (?,?,?)');

            //$id = $_POST["id"];
            $name = $_POST["Name"];
            $developer = $_POST["Developer"];
            $score = $_POST["Score"];

           // $statement->bindParam(1, $id, PDO::PARAM_STR);
            $statement->bindParam(1, $name, PDO::PARAM_STR);
            $statement->bindParam(2, $developer, PDO::PARAM_STR);
            $statement->bindParam(3, $score, PDO::PARAM_STR);
            $numberRows = $statement->execute();
            print("$numberRows rows modified");
        } catch (PDOException $e) {
            print 'Exception!: ' . $e->getMessage();
        }
        $pdo = null;
    }
}
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Add game(s)</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>


    <div class="content">
        <div class="title m-b-md">
            Add a game
        </div>

    </div>
</div>
</body>
</html>
<form method="post">
    <label>Name</label>
    <input type="text" name="Name"/>
    <label>Developer</label>
    <input type="text" name="Developer"/>
    <label>Score</label>
    <input type="text" name="Score"/>
    <input  type="submit" onclick="redirect()" name="addButton"/>

</form>
