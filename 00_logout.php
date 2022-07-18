<?php
session_start();

session_destroy();

header("Location: 00___entrada.php");
?>