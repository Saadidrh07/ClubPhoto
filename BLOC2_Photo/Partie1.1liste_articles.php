<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
<?php include"bd_connexion.php";
                 $conn=connexionPDO();
               
                 include('Bloc_entete.php');
                
?>

<body>

    <form action="" method="GET">
        <h2>Nos photos</h2><br>

        <fieldset>--Choix de type d'articles--
            <select name="idtype">
                <?php 
                     
                 $req="SELECT* from type";
                 $prep=$conn->prepare($req);
                 $prep ->execute();
                 while($ligne=$prep->fetch(PDO::FETCH_OBJ )){

                  echo"<option value='$ligne->idtype'>$ligne->nomtype</option>" ;
                }
                
            ?><input class=" SS" type="submit" value="choisir" name="CHOISIR">
            </select>
        </fieldset><br> <br>
    </form>
    <?php


if(isset($_GET['CHOISIR'])){
        
    $req="select* from type";
    $prep=$conn ->prepare($req);
    $ligne=$prep->fetch(PDO::FETCH_OBJ);
        echo "<h2>Listes des photos de nos artciles de type ".$_GET['idtype']. "</h2> ";


    $req=(" select* From photo inner join article on photo.idarti=article.idarti where idtype=?");
    $prep=$conn ->prepare($req);
    $prep->bindValue(1,$_GET["idtype"]);
    $prep->execute();
    echo"<table>";
        WHILE($ligne=$prep->fetch(PDO::FETCH_OBJ)){

        echo"<tr>";
            echo"<td>$ligne->idarti</td>
            <td>";
                echo"<a href='Partie1.1liste_photos.php?photo=$ligne->idphoto'>$ligne->titrephoto </a></td>";
            echo"<td>$ligne->datearti</td>
            <td>$ligne->textearti</td>";
            echo "<td> <img src='images/$ligne->imagephoto' alt='' width='200' height='200' /></td>" ;
            echo"
        </tr>";
        }
        echo"</table>";
    }
    ?>
    <!--
        < <input class=" SS" type="submit" value="choisir" name="CHOISIR">
            <table>
                <tr>
                    <td><a class="sss" href="">Palmier</a></td>
                    <td>MUSA sfdfhtf</td>
                    <td><img class="dd" src="images/palmier-phoenix-canariensis-.jpg" alt=" ">
                </tr>
                <tr>
                    <td><a class="sss" href="">Bananier</a></td>
                    <td>Mahdghtria Anders</td>
                    <td><img class="dd" src="images/bananier-cavendish.jpg" alt=""></td>

                    </td>
                </tr>
            </table>-->


    <?php
	include('Bloc_pied.php');
?>
</body>

</html>