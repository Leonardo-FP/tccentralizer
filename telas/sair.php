<?php

session_start();
unset ($_SESSION['nome']);
unset ($_SESSION['senha']);
echo "<script>location.href='./index.php';</script>";

?>