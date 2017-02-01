<?php

// https://devcenter.heroku.com/articles/cleardb#using-cleardb-with-php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$mysqli = new mysqli($server, $username, $password, $db);

// http://tutorial.world.edu/web-development/create-mysqli-php-insert-select-update-delete-mysql-database-table/

/*
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

mysqli_report(MYSQLI_REPORT_ERROR); // Quitar en producción

// INSERT
$name = "Daniel";
$email = "daniel@world.edu";
$country = "India";

$stmt = $mysqli->prepare("INSERT INTO people (name,email,country) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name,
    $email,
    $country
);
$stmt->execute();
$stmt->close();


// SELECT
$stmt = $mysqli->prepare("SELECT name, email, country FROM people");
$stmt->execute();
mysqli_stmt_bind_result($stmt,$name,$email,$country);

/* now we want to fetch the data from the database */
while (mysqli_stmt_fetch($stmt)) {
    printf("%s %s %s\n", $name,$email,$country);
}
/* close statement */
mysqli_stmt_close($stmt);
