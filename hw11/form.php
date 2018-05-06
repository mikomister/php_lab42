<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Php Tasks | Konkov Michael</title>
    <link href="https://fonts.googleapis.com/css?family=Squada+One" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="task">
    <h2 class="h2-task">Task 4 | Show JSON</h2>
    <form action="/hw11/proxy.php" method="POST">
                <textarea name="strsToJSON" id="sort" cols="30" rows="10"><?php
                    if (isset($_SESSION["task11"]))
                        echo $_SESSION["task11"];
                    ?></textarea>
        <input type="submit" value="Get JSON">
    </form>
</div>
</body>
</html>