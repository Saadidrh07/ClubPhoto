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
    <h2>Nos photographes</h2>
    <?php echo"<table>";
        $req=(" select* From photographe");
        $prep=$conn ->prepare($req);
        $prep->execute();
        echo"<tr>";
                echo"<td>Liste des photographes</td>";
                echo"<td>  </td>";
                
                echo "</tr>";
                
            WHILE($ligne=$prep->fetch(PDO::FETCH_OBJ)){

                echo"<tr>";
                echo"<td>$ligne->nomphotographe $ligne->prenomphotographe </td>";
               
                echo"<td> <a href='partie3.photographe.php?photographe=$ligne->idphotographe'>MODIFIER </a> </td>";
                echo "</tr>  " 
                ;
                
            }
            echo "</table>";
            ?>
    <?php
     if(isset($_GET['photographe'])){
        $req=" select * From photographe where idphotographe = ? ";
         $prep=$conn->prepare($req);
        $prep->bindValue(1,$_GET['photographe']);
       
        $prep->execute();
        $ligne=$prep->fetch(PDO::FETCH_OBJ);
    
      echo "<form action='' method='POST'>
        <label for=''>Modifier un photographe</label>
        <input type='text'  value='$ligne->nomphotographe' name='nom'>
        <input type='text' value='$ligne->prenomphotographe' name='prenom'>
        <input type= 'submit' value='Modifier' name='modifier'>
    </form>";

     }
     
?>

    <?php
    
    if(isset($_POST['modifier'])){
        $req=" UPDATE photographe
        SET nomphotographe=?,prenomphotographe=?
        WHERE idphotographe = ? ";
        $prep=$conn ->prepare($req);
        
        $prep->bindValue(1,$_POST['nom']);
        $prep->bindValue(2,$_POST['prenom']);
        $prep->bindValue(3,$_GET['photographe']);
       $prep->execute();
    }
     ?>
    <?php
     
	include('Bloc_pied.php');
?>
</body>

</html>