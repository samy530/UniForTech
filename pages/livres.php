<?php
session_start();
echo'<title>Bibliothèque</title>';
echo'<link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">';
include("./navbar.php");
include('../config/config.php');

 //Traitement de la recherche
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT id, titre, image FROM livres WHERE titre LIKE '%$search%'";
} else {
    $sql = "SELECT id, titre, image FROM livres";}

$result = $connexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="../static/css/livres.css">
</head>
<body>
    <header class="header1">
        <div class="background">
            <h1 class="h1_livre">TROUVEZ LES MEILLEURS LIVRES D'ÉTUDE CHEZ UNIFORTECH</h1>
            <hr class="hrhead">
            <p class="headp">Rechechez Vos Livres</p>
            <div class="searchcontainter">
                <div class="container">
                  <input checked="" class="checkbox"  onclick="submitForm()" type="checkbox">
                    <!-- Utilisation de l'attribut id pour cibler le formulaire dans le script JavaScript -->
                    <form id="searchForm" action="" method="GET">
                        <div class="mainbox">
                            <div class="iconContainer">
                                <svg onclick="submitForm()" viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="search_icon">
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                                </svg>
                            </div>
                            <!-- Utilisation de l'attribut id pour cibler le champ de texte dans le script JavaScript -->
                            <input id="searchInput" class="search_input" name="search" onkeypress="handleKeyPress(event)" placeholder="Recherche..." type="text">
                        </div>
                    </form>
                </div>
            </div>
    </header>
    <div class="intro">
        <div class="introimg"><img src="../static/img/biblio_img.jpg" alt=""></div>
       <div class="introtxt">
       <p class="introp"> 
            <p class="title"> Plongez dans notre bibliothèque numérique :</p>
            <hr class="introline">
            <p class="txt">
            une mine d'or pour les étudiants
             en informatique. Parcourez nos livres soigneusement sélectionnés, des bases de données 
             à l'intelligence artificielle, pour nourrir votre soif de connaissances et enrichir
             votre parcours d'apprentissage.</p></p>
    </div>
    </div> 
    <div class="arrivals">
        <div class="maintitles"> <hr> <h1>Nouveautés</h1> <hr> </div>       
        <div class="arrivals_box">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='hovcontainer'>";
                    echo "<div class='arrivals_card'>";
                    echo "<div class='arrivals_image'>";
                    echo "<img src='" . $row['image'] . "'>";
                    echo "</div>";
                    echo "<div class='overlay'>";
                    echo "<a href='livre_details.php?id=" . $row['id'] . "' class='arrivals_btn'>Learn More</a>";
                    echo "</div>"; 
                    echo "<div class='arrivals_tag'>";
                    // Section de critique
                    echo "<div class='review'>";
                    echo "<div class='star-rating'>";
                    echo "<span class='star' data-value='1'>&#9733;</span>";
                    echo "<span class='star' data-value='2'>&#9733;</span>";
                    echo "<span class='star' data-value='3'>&#9733;</span>";
                    echo "<span class='star' data-value='4'>&#9733;</span>";
                    echo "<span class='star' data-value='5'>&#9733;</span>";
                    echo "</div>";
                    echo "</div>"; // Fin de la section de critique
                    echo"<hr class='cardline'>";
                    echo "<p>" . $row['titre'] . "</p>";
                    echo"<hr class='cardline'>";
                    echo "</div>";
                    echo "</div>"; 
                    echo "</div>"; 
                }
            } else {
                echo "Aucun livre trouvé.";
            }
            ?>
        </div>
    </div>
<?php include("./footer.php"); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reviews = document.querySelectorAll('.review');

            reviews.forEach(review => {
                const stars = review.querySelectorAll('.star');
                const ratingValue = review.querySelector('.rating-value');
                let currentRating = 0;

                stars.forEach(star => {
                    star.addEventListener('click', () => {
                        currentRating = star.getAttribute('data-value');
                        updateStars(stars, currentRating);
                       
                    });
                });
            });

            function updateStars(stars, value) {
                stars.forEach(star => {
                    if (star.getAttribute('data-value') <= value) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                });
            }
        });
    </script>
<script>
    function handleKeyPress(event) {
        if (event.key === "Enter") {
            submitForm();
        }
    }

    function submitForm() {
        document.querySelector('.Form').submit();
    }
</script>
</body>
</html>
