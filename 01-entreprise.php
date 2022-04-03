<?php
// Je définie le titre
$titre = "Back office entreprise";

// INCLUSION DU HEADER
require_once '../entreprise/includes/header_entreprise.php'; 
// CONNECTION A LA BASE DE DONNEES
require('../entreprise/connect.php');

// CONNECTION A LA BASE DE DONNEES
require_once '../entreprise/connect.php';

?>
    <main>
        <div class="p-5 bg-light">
            <div class="container">
                <h1 class="display-3">Back Office Entreprise</h1>
                <p class="lead">Page d'accueil</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="02-entreprise.php" role="button">Les employés</a>
                </p>
            </div>
        </div><!-- fin header -->
  
        <div class="container bg-white mt-2 mb-2 m-auto p-2">
            <section class="row">
                <div class="col-12">
                    <h2>les employés</h2>
                    <?php
                    // 4- J'affiche un tableau avec les personnes travaillant à la direction, du salaire le plus élevé au salaire le plus bas
                    $requete = $pdoEntreprise->query(" SELECT * FROM employes WHERE service='direction' ORDER BY salaire DESC");
                    ?>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Sexe</th>
                                <th>Service</th>
                                <th>Salaire</th>
                                <th>Date d'embauche</th>    
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) { ?><!-- ouverture de la boucle while -->
                                <tr>
                                    <td><?php echo $ligne['id_employes']; ?></td>
                                    <td><?php echo $ligne['nom']; ?></td>
                                    <td><?php 
                                    if($ligne['sexe'] == 'f'){
                                        echo "Femme";
                                    }else{
                                        echo "Homme";
                                    }
                                    ?></td>
                                    <td><?php echo $ligne['prenom']; ?></td>
                                    <td><?php echo $ligne['service']; ?></td>
                                    <td><?php echo $ligne['salaire']; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($ligne['date_embauche'])); ?></td>
                                </tr>
                            <?php } ?><!-- fermeture de la boucle -->
                        </tbody>
                    </table>

                </div><!-- fin col -->
                
                <div class="col-12 col-md-6">
                        <div class="shadow p-3 rounded">
                            <p><span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam, illo cupiditate. Quae, labore ipsa. Ipsum voluptatem cum assumenda dolorem, quo architecto adipisci numquam, aliquam exercitationem dolorum, laboriosam veniam ea tenetur.</span><span>Officiis voluptatibus omnis libero quidem. Aliquid omnis fugit incidunt dolor dicta reprehenderit tempore! Laboriosam, ut dolore dolorem, sit, harum pariatur numquam odio doloribus ducimus expedita totam ipsam. Veniam, fugit adipisci?</span></p>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique velit amet accusantium optio fuga nobis error unde quis iste aliquid corrupti ea officia beatae voluptas, corporis sapiente atque vero. Tempora! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt inventore aut magnam fugit explicabo vero, adipisci et itaque culpa dolor voluptates ullam excepturi, architecto voluptatem magni nemo autem! Molestias, atque.</p>
                        </div>
                    </div><!-- fin col -->
                    <div class="col-12 col-md-6">
                        <div class="shadow p-3 rounded">
                            <p><span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam, illo cupiditate. Quae, labore ipsa. Ipsum voluptatem cum assumenda dolorem, quo architecto adipisci numquam, aliquam exercitationem dolorum, laboriosam veniam ea tenetur.</span><span>Officiis voluptatibus omnis libero quidem. Aliquid omnis fugit incidunt dolor dicta reprehenderit tempore! Laboriosam, ut dolore dolorem, sit, harum pariatur numquam odio doloribus ducimus expedita totam ipsam. Veniam, fugit adipisci?</span></p>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique velit amet accusantium optio fuga nobis error unde quis iste aliquid corrupti ea officia beatae voluptas, corporis sapiente atque vero. Tempora! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt inventore aut magnam fugit explicabo vero, adipisci et itaque culpa dolor voluptates ullam excepturi, architecto voluptatem magni nemo autem! Molestias, atque.</p>
                        </div>
                    </div><!-- fin col -->
            </section><!-- fin row -->
            
        </div>
        <!-- fin container  -->
    </main>
    <!-- FIN MAIN -->

<!-- INCLUSION DU FOOTER -->
<?php require_once '../entreprise/includes/footer_entreprise.php'; ?>
   
</body>

</html>