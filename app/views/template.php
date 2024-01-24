
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/menu.css">
    <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/telainicial.css">
    <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/criar.css">
    <link rel="shortcut icon" href="<?php echo URL_BASE."assets/"?>images/logo/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/explorar.css">
    <link rel="stylesheet" href="<?php echo URL_BASE."assets/"?>src/css/caixa.css">

    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE."assets/"?>src/css/perfiluser.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE."assets/"?>src/css/sobreimg.css">

    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE."assets/"?>src/css/editarperfil.css">
    <title>AI Pinboard</title>
</head>
<body>
<?php 

if(!isset($_SESSION)) session_start();
if($_SESSION){
    if(isset($_SESSION["user_id"])) include_once "user_logged/elements/menu.php";
    else  include_once "elements/menu.php";
}else  include_once "elements/menu.php";

?>

<?php $this->load($view, $viewData);?>
 
</body>
</html>