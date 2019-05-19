<?php

try {
    $con = new \PDO("mysql:host=" . HOST . ":" . PORT . ";dbname=" . DB . "", "" . USER . "", "" . PASS . "");
} catch (\PDOException $erro) {
    return $erro->getMessage();
}

$number = count($_POST["name"]);

if($number > 1){
    for($i=0; $i<$number; $i++){
        if(trim($_POST["name"][$i]) !== ''){
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $con->prepare("INSERT INTO tb_doacao(especie) VALUES(:especie)");
            $stmt->execute(array(
                ':especie'=>$_POST["name"][$i]
            ));
        }
        echo $stmt->rowCount();
    }
}else{
    echo "Enter name";
}