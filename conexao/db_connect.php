<?php 
    //Conexão com banco de dados
$servername = "109.106.251.136";
$username = "tccentra_leo";
$password = "12345";
$db_name = "tccentra_tccentralizer";

$connect = mysqli_connect($servername,$username,$password,$db_name);

if(mysqli_connect_error()){

    echo "Erro na conexão: ".mysqli_connect_error();
}   else {
        echo "Sucesso!";
}
