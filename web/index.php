<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta lang="en" />
    <title>Heroku-PHP</title>
</head>
<h1>Ejemplo de PHP+MySQL en Heroku</h1>
<body>
<?php

// https://devcenter.heroku.com/articles/cleardb#using-cleardb-with-php
// http://tutorial.world.edu/web-development/create-mysqli-php-insert-select-update-delete-mysql-database-table/
// http://www.generatedata.com/

// Obtener los datos de conexión de Heroku
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

// Conectar
$mysqli = new mysqli($server, $username, $password, $db);

//mysqli_report(MYSQLI_REPORT_ERROR);

// Consulta
$stmt = $mysqli->prepare("SELECT nombre, email, ciudad FROM personas");
$stmt->execute();
mysqli_stmt_bind_result($stmt, $nombre, $email, $ciudad);

// Visualizar los datos
printf("<table>");
while (mysqli_stmt_fetch($stmt)) {
    printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $nombre, $email, $ciudad);
}
printf("</table>");

mysqli_stmt_close($stmt);
?>
</body>
</html>
