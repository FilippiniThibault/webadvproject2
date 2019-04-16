<?php


if(isset($_POST)){
    if(isset($_POST["verwijderButton"])){
        $user = 'root';
        $password = 'root';
        $database = 'games';
        $pdo = null;
        $names = $_POST["name"];
        $ontwikkelaars = $_POST["ontwikkelaar"];
        $scores = $_POST["score"];
        $ids = $_POST["id"];
        $checkboxes = $_POST["checkbox"];
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$database",
                $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            for ($x = 0; $x < count($ids); $x++) {
                if (isset($checkboxes[$x])) {
                    $idToDelete = $ids[$x];

                    $numberRows = $pdo->exec("DELETE FROM gebruiker WHERE " .
                        "id = " . $idToDelete);
                    print("$numberRows rows modified\n");
                }
            }

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

    <title>Laravel</title>

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
            Delete a game
        </div>

    </div>
</div>
</body>
</html>
<form method="post">

    <input type="text" name="Name"/>
    <input type="text" name="Developer"/>
    <input type="text" name="Score"/>
    <input type="checkbox" name="checkbox">
    <input  type="submit" onclick="redirect()" name="verwijderButton"/>

</form>
