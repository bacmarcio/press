<?php include "verifica.php";
$dadosPost = $posts->dadosPosts();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="painel/">adm</a>
    <a href="area-cliente/">cliente</a><br> 
    <?php foreach ($dadosPost as $item) { ?>
        <a href="releases/<?php echo $item->url_amigavel?>"><?php echo $item->titulo?></a><br>
    <?php }?>   
</body>
</html>