<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>

<body>
    <?php 
    include"bd_connexion.php";
    $conn=connexionPDO();
     include('Bloc_entete.php');
     ?>

    <h2>Mes articles</article>
    </h2><br>

    Liste des articles
    <?php echo"<table>";
        $req=(" select* From photo inner join article on photo.idarti=article.idarti
         inner join photographe on photographe.idphotographe=article.idphotographe inner join type on 
         type.idtype=article.idtype
         ORDER BY datearti DESC");
        $prep=$conn ->prepare($req);
        $prep->execute();
        echo"<tr>";
                echo"<td>Date</td>";
                echo"<td>Titre </td>";
                echo"<td>Détail</td>";
                echo "<td>type</td>";
                echo "<td> Photographe</td>" ;
                echo"<td> Photos</td> ";
                echo "</tr>";
                
            WHILE($ligne=$prep->fetch(PDO::FETCH_OBJ)){

                echo"<tr>";
                echo"<td>$ligne->datearti</td>";
                echo"<td>$ligne->titrearti </td>";
                echo"<td>$ligne->textearti</td>";

                echo "<td> $ligne->nomtype</td>" ;
                echo "<td>$ligne->nomphotographe $ligne->prenomphotographe</td>";
                echo"<td> <a href='Partie1.2info_photos.php?article=$ligne->idarti'>Voir les photos </a> </td>";
                echo "</tr>";
                
            }
            echo"</table> <br><br>";
            if(isset($_GET['article'])){
                $req=" select datearti ,titrearti From article inner join photo on article.idarti=photo.idarti  where article.idarti = ? ";
               $prep=$conn ->prepare($req);
              
               $prep->bindValue(1,$_GET['article']);
                $prep->execute();
                $ligne = $prep ->fetch(PDO::FETCH_OBJ);
                     echo "Les photos du $ligne->datearti : $ligne->titrearti";
                   
                    
            }
            if(isset($_GET['article'])){
                $req=" select*
                 From article inner join photo on article.idarti=photo.idarti  where article.idarti = ? ";
               $prep=$conn ->prepare($req);
                 $prep->bindValue(1,$_GET['article']);
                $prep->execute();
                echo"<table> <tr>";
                echo"<td>Titre</td>";                
                echo"<td>Description</td>";
                echo"<td>Photo</td>";
                echo "</tr>";
                WHILE($ligne=$prep->fetch(PDO::FETCH_OBJ)){

                    echo" <tr>";
                echo"<td>$ligne->titrephoto</td>";
                
                echo"<td>$ligne->textephoto</td>";
                echo"<td><img src='images/$ligne->imagephoto'  width='250'/></td>";
                echo "</tr> <table>";
                } 
            
            }
            ?>
    <?php
            
             if(isset($_POST['ajouter'])){
                
                $req="INSERT INTO photo (titrephoto,textephoto,imagephoto,idarti) VALUES (?,?,?,?)";
                $prep =$conn->prepare($req);
                $prep->bindValue(1,$_POST['titre']);
                $prep->bindValue(2,$_POST['texte']);
                $prep->bindValue(3,$_POST['image']);
                $prep->bindValue(4,$_GET['article']);
                $prep->execute();
             }
             
                    
                    ?>
    <form action="" method="POST" e style="text-align: center;">

        Ajouter une photo
        <p>
            <input type="text" name="titre">
        </p>
        <p>
            <textarea name="texte"> </textarea>
        </p>
        <p><input type="file" name="image"> </p>

        <input type='submit' value='Ajouter' name="ajouter" />


    </form>
    <?php
	include('Bloc_pied.php');
?>

    </fieldset>
    <style>

    </style>

</body>

</html>