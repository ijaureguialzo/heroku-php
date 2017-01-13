<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

$result = mysqli_query($conn, "select * from prueba");

while ($row = mysqli_fetch_array($result)) {
    echo "<p>id: " . $row{'id'} . ", nombre: " . $row{'nombre'}."</p>";
}

mysqli_close($conn);

?>
