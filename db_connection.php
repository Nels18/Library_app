<?php
$servername = "localhost";
$username = "root";

// Create connection
$mysqli = mysqli_connect($servername, $username);


// Select bdd
mysqli_select_db($mysqli, "library");