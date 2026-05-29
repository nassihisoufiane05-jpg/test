<?php
    session_start();
    $serveur = "localhost";
    $dbname = "jeux_videos";
    $login = "root";
    $mdp = "";

    $link = mysqli_connect($serveur, $login, $mdp, $dbname);
    
    if(!$link){
            die("la connexion a échoué: ".mysqli_connect_error());
       }

        $monF="";
        $monC="";
        if(isset($_POST['appliquer']) && $_POST['genre']!="" ){
            $monF=" where genres.id ='".$_POST['genre']."'";
        
        }
        if(isset($_POST['appliquer'])){
             switch($_POST['note']){
                    case '10':$monC ="note<10";break;
                    case '15':$monC ="note>10 and note<15";break;
                    case '20':$monC ="note>15 and note<20";break;
        }
        }

        

        $sql="SELECT * FROM genres";
        print($sql);
        $stmt=mysqli_prepare($link,$sql);
        mysqli_stmt_execute($stmt);
        $resultat=mysqli_stmt_get_result($stmt);
        

        $sql1 ="SELECT * 
         FROM jeux 
         INNER JOIN genres 
         ON genres.id = jeux.genre_id
         INNER JOIN studios
         ON studios.id = jeux.studio_id".$monF.$monC;
        $stmt1=mysqli_prepare($link,$sql1);
        mysqli_stmt_execute($stmt1);
        $resultat1=mysqli_stmt_get_result($stmt1);

        
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Jeux </title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#121212;
    color:#f1f1f1;
    margin:0;
    padding:40px;
}

h1{
    text-align:center;
    margin-bottom:40px;
    color:#00bfff;
}

h2{
    margin-top:0;
    color:#ffffff;
}

.filtres{
    background:#1e1e1e;
    padding:25px;
    border-radius:14px;
    margin-bottom:40px;
    border:1px solid #2f2f2f;
    box-shadow:0 0 15px rgba(0,0,0,0.3);
}

.timeline{
    position:relative;
    margin-left:20px;
    padding-left:40px;
}

.timeline::before{
    content:"";
    position:absolute;
    left:0;
    top:0;
    width:4px;
    height:100%;
    background:#00bfff;
    border-radius:10px;
}

.jeu{
    position:relative;
    background:#1e1e1e;
    padding:20px;
    margin-bottom:30px;
    border-radius:14px;
    border:1px solid #2d2d2d;
    box-shadow:0 4px 15px rgba(0,0,0,0.25);
    transition:0.2s;
}

.jeu:hover{
    transform:translateY(-3px);
}

.jeu::before{
    content:"";
    position:absolute;
    left:-50px;
    top:28px;
    width:18px;
    height:18px;
    background:#00bfff;
    border:4px solid #121212;
    border-radius:50%;
}

.jeu p{
    margin:8px 0;
    color:#d6d6d6;
}

strong{
    color:#ffffff;
}

form{
    margin-bottom:20px;
}

input,
select{
    width:280px;
    padding:10px;
    margin-top:6px;
    margin-bottom:15px;
    border:none;
    border-radius:8px;
    background:#2b2b2b;
    color:white;
    font-size:14px;
}

input:focus,
select:focus{
    outline:2px solid #00bfff;
}

button{
    background:#00bfff;
    color:white;
    border:none;
    padding:12px 22px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:0.2s;
}

button:hover{
    background:#0099cc;
}

hr{
    border:none;
    height:1px;
    background:#333;
    margin:50px 0;
}

label{
    font-weight:bold;
}

input[type="radio"]{
    width:auto;
    margin-right:5px;
}

</style>
</head>
<body>

<h1>Bibliothèque</h1>

<div class="filtres">

<form method="POST">

<label>Genre :</label>
<!-- OPTIONS GENRES (à remplaceer par du code php) -->
<select name="genre">

<option value="">Tous</option>
<?php
while($ligne=mysqli_fetch_assoc($resultat)){?>

<option value="<?=$ligne['id']?>"><?=$ligne['nom_genre']?></option>

<?php
}
?>


</select>

<br><br>

<label>Note :</label>

<input type="radio" name="note" value="all" checked> Tous
<input type="radio" name="note" value="10"> 0 à 10
<input type="radio" name="note" value="15"> 11 à 15
<input type="radio" name="note" value="20"> 16 à 20

<br><br>

<button type="submit" name="appliquer">Filtrer</button>

</form>

</div>

<div class="timeline">

<!-- AFFICHAGE DES JEUX (à remplaceer par du code php) -->
 <?php
 while($ligne1=mysqli_fetch_assoc($resultat1)){?>

<div class="jeu">

<h2><?=$ligne1['titre']?></h2>

<p><strong>Année :</strong> <?=$ligne1['titre']?></p>

<p><strong>Genre :</strong> <?=$ligne1['nom_genre']?></p>

<p><strong>Studio :</strong> <?=$ligne1['nom_studio']?></p>

<p><strong>Note :</strong> <?=$ligne1['note']?></p>

<p><strong>Ajouté par :</strong> <?=$ligne1['ajoute_par']?></p>

</div>
<?php }
?>



<hr>

<h2>Ajouter un jeu</h2>

<form method="POST">

<input type="text" name="titre" placeholder="Titre">

<br>

<input type="number" name="annee" placeholder="Année">

<br>

<input type="number" name="note_insert" placeholder="Note">

<br>

<select name="genre_insert">

<!-- GENRES INSERT -->

</select>

<br>

<select name="studio_insert">

<!-- STUDIOS INSERT -->

</select>

<br>

<input type="text" name="auteur" placeholder="Votre prénom">

<br>

<button type="submit">Ajouter</button>

</form>

</body>
</html>