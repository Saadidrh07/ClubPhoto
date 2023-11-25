<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style3.css">
    <title>Document</title>
</head>
<style>

</style>

<body>

    <?php 
    include('Bloc_entete.php');
    include('bloc_menu.php');
    include "bd_connexion.php";
    $connex = connexionPDO();?>

    <div class="Gpa">
        <div class="koulchi">
            <div class="Partie1"> Détail de la photo n°<?php echo $_GET['photo'] ?></div> <?php
        $req="SELECT * FROM article inner join photo on article.idarti 
        = photo.idarti inner join type on article.idtype =type.idtype WHERE idphoto = ? ";
        $prep =$connex->prepare($req);
        $prep->bindValue(1,$_GET['photo']);
        $prep->execute();
        while($ligne = $prep ->fetch(PDO::FETCH_OBJ)){
        echo " <div class='Partie2'> Titre : "."$ligne->titrephoto"."<br/></div>";
        echo "<div class='Partie3'>Texte : "."$ligne->textephoto"."<br/> </div>";
        echo " <div class='Partie4'> Attaché a l'article : "."$ligne->titrearti"."<br/></div>";
        echo "<div class='Partie5'>Type de l'article : "."$ligne->nomtype"."<br/></div></div>";
        echo "<img src='images/$ligne->imagephoto' height='160' width='200'/>"; }?>
        </div>


        <?php include('bloc_pied.php');?>

</body>

</html>