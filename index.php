<?php


if(!file_exists(".htaccess")){
    $temp = fopen(".htaccess", "w");
    if(!$temp) die("HOUVE ERRO NA CRIACAO DE ARQUIVOS DE SERVIDOR");
    fwrite($temp, "
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]");
    fclose($temp);
}

require 'config/config.php';
require 'app/core/Core.php';
require 'vendor/autoload.php';

$core = new Core;
$core->run();

/*
echo "contoller: " .$core->getController();
echo "<br>Método : " .$core->getMetodo();
$parametros = $core->getParametros();
foreach ($parametros as $param)
    echo "<br>Parâmetro : " .$param;*/

