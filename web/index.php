<?php

// https://devcenter.heroku.com/articles/cleardb#using-cleardb-with-php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$mysqli = new mysqli($server, $username, $password, $db);

// http://tutorial.world.edu/web-development/create-mysqli-php-insert-select-update-delete-mysql-database-table/

mysqli_report(MYSQLI_REPORT_ERROR); // Quitar en producción

// http://www.generatedata.com/

$stmt = $mysqli->prepare("SELECT nombre, email, ciudad FROM personas");
$stmt->execute();
mysqli_stmt_bind_result($stmt, $nombre, $email, $ciudad);

printf("<table>");
while (mysqli_stmt_fetch($stmt)) {
    printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $nombre, $email, $ciudad);
}
printf("</table>");

mysqli_stmt_close($stmt);
