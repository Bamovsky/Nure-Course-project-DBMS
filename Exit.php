<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['IsManager']);
header('Location: index.php');