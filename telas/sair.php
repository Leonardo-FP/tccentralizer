<?php
    session_start();
    $token = md5(session_id());
    if(isset($_GET['token']) && $_GET['token'] === $token) {
        session_destroy();

        echo "<script>location.href='../index.php';</script>";
        
        exit();

    } else {
        echo '<a class="btn btn-lg btn-primary btn-block" href="sair.php?token='.$token.'>Confirmar logout</a>';
    }

?>