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

//ini_set('session.gc_maxlifetime', ($timeout * 60)); // tempo máximo da seção em segundos
ini_set('session.use_strict_mode', true); // aceitar apenas sessões criadas pelo módulo session
ini_set('session.use_cookies', true); // usar junto com use_only_cookies
ini_set('session.use_only_cookies', true); // cookies gerados apenas pelo proprio usuário
ini_set('session.cookie_httponly', true); // cookies só acessíveis por HTTP (não JS)
ini_set('session.cookie_secure', true); // cookies só acessíveis por HTTPS
ini_set('session.hash_function', 'sha512'); // criptografa session: dificulta Session Hijacking       
ini_set('session.use_trans_sid', false); // suporte a SID transparente desabilitado
ini_set('session.referer_check', 'http://localhost/projetos/ia-pinboard/'); // checa o referer
ini_set('session.cache_limiter', 'nocache'); // não fazer cache

//session_regenerate_id(); // renova ID da seção
session_start(); // IMPORTANTE: ao final dos comandos acima
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

