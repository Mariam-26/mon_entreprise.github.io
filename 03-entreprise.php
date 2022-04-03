<?php
// Je définie le titre
$titre = "Les salariés";

// INCLUSION DU HEADER
require_once '../entreprise/includes/header_entreprise.php'; 
// CONNECTION A LA BASE DE DONNEES
require('../entreprise/connect.php');

// CONNECTION A LA BASE DE DONNEES
require_once '../entreprise/connect.php';

// 3- Réception des infos d'un employé avec $_GET
if (isset($_GET['id_employes'])) {
    $resultat = $pdoEntreprise->prepare(" SELECT * FROM employes WHERE id_employes = :id_employes ");
    $resultat->execute(array(
        ':id_employes' => $_GET['id_employes'] // on associe le marqueur vide à l'id_employes
    ));
    if ($resultat->rowCount() == 0) {
        header('location:02-entreprise.php');
        exit();
    }
    $fiche = $resultat->fetch(PDO::FETCH_ASSOC); /* Sr notre variable résultat qui contient notre requête (ici  on sélection ttes ls infos d'un employé donné)  on demande fetch (va chercher) et on lui indique qu'il ft recupérer les infos ds la BDD FETCH_ASSOC permet de renvoyer ls résultats d'une rangée comme venant d'un tableau*/
} else {/* si la personne vient sur la page juste 03-entreprise.ph on la renvoie vers la page °2-entreprise.php //Doit être à l'exterieur du if principal car on demande de sortir di on ne récupère ps l'id_employes ds l'URL  */
    header('location:02-entreprise.php');
    exit();
}

//4- MàJ d'un employé
if (!empty($_POST)) {
    $_POST['prenom'] = htmlspecialchars($_POST['prenom']);
    $_POST['nom'] = htmlspecialchars($_POST['nom']);
    $_POST['sexe'] = htmlspecialchars($_POST['sexe']);
    $_POST['service'] = htmlspecialchars($_POST['service']);
    $_POST['date_embauche'] = htmlspecialchars($_POST['date_embauche']);
    $_POST['salaire'] = htmlspecialchars($_POST['salaire']);

    $resultat = $pdoEntreprise->prepare(" UPDATE employes SET prenom = :prenom, nom = :nom, sexe = :sexe, service = :service, date_embauche = :date_embauche, salaire = :salaire WHERE id_employes = :id_employes ");
    /* On utilise prepare lorsque l'on prépare une requête avec des marqueurs (:nomduchamp) */

    $resultat->execute(array(
        ':prenom' => $_POST['prenom'],
        ':nom' => $_POST['nom'],
        ':sexe' => $_POST['sexe'],
        ':service' => $_POST['service'],
        ':date_embauche' => $_POST['date_embauche'],
        ':salaire' => $_POST['salaire'],
        ':id_employes' => $_GET['id_employes'],
    ));
    /* Je fais ensuite correspondre les marqueurs jusqu'à là vides aux donnéees que je récupère de mon formulaire */

    header('location:02-entreprise.php');
    exit();
}

?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Back Office Entreprise - MàJ d'un employé</title>

</head>

<body>
   
    <div class="p-5 bg-light">
        <div class="container">
            <h1 class="display-3">Back Office Entreprise</h1>
            <p class="lead">Mise à jour de l'employé #<?php echo $fiche['id_employes'] ?></p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="02-entreprise.php" role="button">Voir tous les employés</a>
            </p>
        </div>
    </div>
    <main class="container">
        <section class="row my-5">

            <div class="col-md-4 alert-primary rounded p-5">
                <!-- J'affiche toutes les informations relatives à l'employé sélectionné -->

                <h2 class="text-center mb-4">Fiche de l'employé
                    <?php if ($fiche['sexe'] == 'f') {
                        echo "e";
                    } ?></h2>

                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center"><?php echo $fiche['prenom'] . " " . $fiche['nom']; ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Service : <?php echo $fiche['service'] ?></p>
                        <p class="card-text">Genre :
                            <?php
                            if ($fiche['sexe'] == 'f') {
                                echo "Féminin";
                            } else {
                                echo "Masculin";
                            }
                            ?>
                        </p>
                        <p class="card-text">Date d'embauche :
                            <?php
                            echo date('d/m/Y', strtotime($fiche['date_embauche']))
                            ?>
                        </p>
                        <p class="card-text">Salaire : <?php echo $fiche['salaire']; ?>€</p>
                    </div>
                </div>

            </div>
            <!-- fin col -->

            <div class="col-md-8 alert-warning p-5 rounded">
                <!-- Je m'occupe de la màj de la fiche de l'employé concerné -->
                <h2 class="text-center">Mettre à jour <?php  ?></h2>
                <form action="#" method="POST">
                    <!-- IL FAUT PENSER LORSQUE L'ON FAIT UN FORMULAIRE DE MISE A JOUR A PASSER EN VALUE LES DONNEES POUR VOIR CE QUI ETAIT AVANT ET CE QUE L'ON VEUT CHANGER -->

                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $fiche['prenom']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $fiche['nom']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="sexe" class="form-label">Sexe </label><br>
                        <input type="radio" name="sexe" value="m" id="sexe" checked> Homme <br>
                        <input type="radio" name="sexe" value="f" <?php if (isset($fiche['sexe']) && $fiche['sexe'] == 'f') echo ' checked'; ?> id="sexe"> Femme
                        <!-- Ici je me sers d'input de type radio // grâce à mon code PHP je dis que si je sélectionne une femme depuis les employés c'est femme qui sera checked, si c'est le contraire c'est homme qui sera checked -->
                    </div>

                    <div class="mb-3">
                        <label for="service" class="form-label">Service</label>
                        <select name="service" id="service" class="form-select">
                            <!-- POUR LE SERVICE, JE BOUCLE SUR LES SERVICES EXISTANTS DANS LA BDD AFIN DE NE PAS AVOIR UN CODE TROP LONG || CODE THOMASTORRENTE -->
                            <?php
                            // requete pour le select du service
                            $requete_service = $pdoEntreprise->query("SELECT DISTINCT service FROM employes");
                            while ($service = $requete_service->fetch(PDO::FETCH_ASSOC)) {

                                echo "<option value=\"" . $service['service'] . "\" >" . $service['service'] . "</option>"; /* ici on sélection ts ls services qui existent ds la BDD et on ls affiche en tant qu'option avec la valeur à laquelle l'option correspond */
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="date_embauche" class="form-label">Date d'embauche</label>
                        <input type="date" name="date_embauche" id="date_embauche" class="form-control" value="<?php echo $fiche['date_embauche']; ?>"><!-- Bien penser à mettre un input type date -->
                    </div>

                    <div class="mb-3">
                        <label for="salaire" class="form-label">Salaire</label>
                        <input type="number" name="salaire" id="salaire" class="form-control" value="<?php echo $fiche['salaire']; ?>">
                    </div><!-- Ici un input de type number pour être sur de ne pas insérer de string -->

                    <button type="submit" class="btn btn-warning">Mettre à jour</button>
                </form>

            </div>
            <!-- fin col -->
        </section>
        <!-- fin row -->
        </div>
        <!-- fin container  -->
    </main>
    <!-- FIN MAIN -->

  <!-- INCLUSION DU FOOTER -->
<?php require_once '../entreprise/includes/footer_entreprise.php'; ?>
</body>

</html>