<?php
session_start();

$serveur = '192.168.1.253';
$namebd = 'sports';
$login = '6qib';
$mdp = 'Irc2026';

$monLien = mysqli_connect($serveur, $login, $mdp, $namebd);

if(!$monLien){
    die("La connexion a échoué " . mysqli_connect_error());
}






// Selection de tous les sports
$sql = "select * from disciplines ";
$stmt = mysqli_prepare($monLien, $sql);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);


// Background
$fond='background.jpg';
$sport= array();
$taille=60;
if(isset($_POST['appliquer'])){

if(isset($_POST['background'])){
    $fond=$_POST['background'];
}


if(isset($_POST['favoris'])){
    $sport=$_POST['favoris'];

}
if(isset($_POST['taille'])){
    $taille=$_POST['taille'];

}
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Disciplines sportives</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style personnalisé -->
    <link rel="stylesheet" href="css/style.css">

<style>
    body{
        background-image: url("images/<?=$fond?>");
    }
    .card-img-top{
        width:<?=$taille?>%;
    }
</style>

</head>

<body>

<div class="container-fluid py-5">

    <fieldset style="border: 2px solid white; padding: 1rem; margin: 2rem; color:white;">
        <legend style="color: white; font-weight: bold;">Sports favoris :<legend>
            <?php
            foreach ($sport as $value) {
                print($value."<br>");
                
                
            }
            
            ?>
             
 
    </fieldset>

    <div class="row">

        <!-- Colonne gauche -->
        <div class="col-md-2 px-4">

            <form method="post" action="">

                <!-- Choix du fond -->
                <div class="mb-3">
                    <label class="form-label">Image de fond :</label><br>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="background"
                               value="background.jpg"
                               id="bg1"
                               checked>

                        <label class="form-check-label" for="bg1">
                            Fond 1 (background.jpg)
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="background"
                               value="background2.jpg"
                               id="bg2">

                        <label class="form-check-label" for="bg2">
                            Fond 2 (background2.jpg)
                        </label>
                    </div>
                </div>

                <!-- Liste des sports -->
                <div class="mb-3">

                    <label for="sport" class="form-label">
                        Choisir un sport :
                    </label>

                    <select class="form-select" id="sport" name="sport">

                        <option value="">-- Tous --</option>

                        <option value="Football">Football</option>
                        <option value="Basketball">Basketball</option>
                        <option value="Tennis">Tennis</option>
                        <option value="Natation">Natation</option>
                        <option value="Rugby">Rugby</option>
                        <option value="Athlétisme">Athlétisme</option>
                        <option value="Boxe">Boxe</option>
                        <option value="Judo">Judo</option>
                        <option value="Escrime">Escrime</option>
                        <option value="Cyclisme">Cyclisme</option>
                        <option value="Golf">Golf</option>
                        <option value="Hockey">Hockey</option>
                        <option value="Ski">Ski</option>
                        <option value="Surf">Surf</option>
                        <option value="Volley">Volley</option>

                    </select>
                </div>

                <!-- Taille -->
                <div class="mb-3">

                    <label for="taille" class="form-label">
                        Taille des cartes (60 à 75%)
                    </label>

                    <input type="number"
                           class="form-control"
                           id="taille"
                           name="taille"
                           min="60"
                           max="75"
                           value="60">
                </div>

                <!-- Favoris -->
                <h4 class="mt-4">
                    Choisissez vos sports favoris :
                </h4>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Football"
                           id="football">

                    <label class="form-check-label" for="football">
                        Football
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Basketball"
                           id="basketball">

                    <label class="form-check-label" for="basketball">
                        Basketball
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Tennis"
                           id="tennis">

                    <label class="form-check-label" for="tennis">
                        Tennis
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Judo"
                           id="judo">

                    <label class="form-check-label" for="judo">
                        Judo
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Athlétisme"
                           id="athletisme">

                    <label class="form-check-label" for="athletisme">
                        Athlétisme
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Natation"
                           id="natation">

                    <label class="form-check-label" for="natation">
                        Natation
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Cyclisme"
                           id="cyclisme">

                    <label class="form-check-label" for="cyclisme">
                        Cyclisme
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Rugby"
                           id="rugby">

                    <label class="form-check-label" for="rugby">
                        Rugby
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Handball"
                           id="handball">

                    <label class="form-check-label" for="handball">
                        Handball
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Boxe"
                           id="boxe">

                    <label class="form-check-label" for="boxe">
                        Boxe
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="favoris[]"
                           value="Cricket"
                           id="cricket">

                    <label class="form-check-label" for="cricket">
                        Cricket
                    </label>
                </div>

                <!-- Bouton -->
                <button type="submit"
                        class="btn btn-primary mt-3"
                        name="appliquer">

                    Appliquer

                </button>

            </form>

        </div>

        <!-- Colonne droite -->
        <div class="col-md-9">

            <div class="d-flex flex-column align-items-center gap-4">

                <?php while ($ligne = mysqli_fetch_assoc($res)) { ?>

                    <div class="card wide-card shadow-lg">

                        <img src="images/<?=$ligne['image']?>"
                             class="card-img-top"
                             alt="sport">

                        <div class="card-body">

                            <h5 class="card-title">
                                <?=$ligne['nom_sport']?>
                            </h5>

                            <p class="card-text">
                                Origine : <?=$ligne['origine']?>
                            </p>

                            <p class="card-text">
                                Milieu : <?=$ligne['milieu']?>
                            </p>

                            <p class="card-text text-center">
                                <small class="text-muted">
                                    Collectif : <?=$ligne['collectif']?>
                                    |
                                    Sportif : <?=$ligne['sportif']?>
                                </small>
                            </p>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>