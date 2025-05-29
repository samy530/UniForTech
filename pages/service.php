
<?php
session_start();
echo'<title>Service</title>';
echo'<link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">';
include("./navbar.php");
include('../config/config.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../static/css/service.css">
  <script src="../static/js/service.js"></script>
  <title>Ressources</title>
</head>

<body>
  <header>
    <h1 class="titre-header">PROFITEZ DE NOS DIVERS SERVICES, DES ANNONCES AUX EVENEMENTS ,NE MANQUEZ AUCUNE NOUVAUTE
      AVEC UNIFORTECH </h1>
    <div class="scroll-down">
      <p class="scromm-txt">Faites défiler vers le bas pour plus d'informations</p>
      <div class="mousey">
        <div class="scroller"></div>
      </div>
    </div>
  </header>
  <section class="txt-apresheader">
    <h1 class="txt-1 h1ensemble">Ensemble, unis pour la technologie! </h1>

    <div class="texte1">
      <div class="vertical-line"></div>
      <p class="txt">Explorez un avenir qui vous appartient avec <span class="uni-fort">UniForTech,</span> 
        nous sommes fiers de vous offrir tout ce dont vous avez besoin pour réussir. UniForTech est dédié à
        votre succès.Découvrez comment nous faisons la différence ensemble, unis pour la technologie !
      </p>
    </div>
    <div class="img-uni">
      <img class="imgg-uni zoom" src="../static/img/pic1services.avif" alt="">
    </div>
  </section>

  <section class="container scroll-1">
    <div class="annoncesdi">
      <h1 class="txt-1">Annonces </h1>
      <p class="txtannonces">Explorez les annonces sur UniforTech, où vous trouverez toutes les informations pertinentes et les dernières nouveautés. 
        Ne manquez rien et restez à jour sur tout ce qui se passe!
        </p>
    </div>
    <div class="ag-courses_box">
      <div class="ag-courses_item">
        <a href="#" class="ag-courses-item_link">
          <div class="ag-courses-item_bg"></div>
          <div class="ag-courses-item_title">
           GDSC: Atelier Programmation Orientée Objet en Python
          </div>
          <div class="ag-courses-item_date-box">
            Start:
            <span class="ag-courses-item_date"> 24 avril 2024 </span>
          </div>
        </a>
      </div>
      <div class="ag-courses_item">
        <a href="#" class="ag-courses-item_link">
          <div class="ag-courses-item_bg"></div>
          <div class="ag-courses-item_title">
            GDSC:  Atelier Mena Skills  
          </div>

          <div class="ag-courses-item_date-box">
            Start:
            <span class="ag-courses-item_date">
              22 mars 2024
            </span>
          </div>
        </a>
      </div>
      <div class="ag-courses_item">
        <a href="#" class="ag-courses-item_link">
          <div class="ag-courses-item_bg"></div>

          <div class="ag-courses-item_title">
            GDSC: Dernier Atelier JavaScript
          </div>

          <div class="ag-courses-item_date-box">
            Start:
            <span class="ag-courses-item_date">
              12 mars 2024
            </span>
          </div>
        </a>
      </div>
      <div class="ag-courses_item">
        <a href="#" class="ag-courses-item_link">
          <div class="ag-courses-item_bg"></div>

          <div class="ag-courses-item_title">
            GDSC: Reprise des Workshops ! 
          </div>

          <div class="ag-courses-item_date-box">
            Start:
            <span class="ag-courses-item_date">
              28 février 2024 
            </span>
          </div>
        </a>
      </div>
      <div class="ag-courses_item">
        <a href="#" class="ag-courses-item_link">
          <div class="ag-courses-item_bg"></div>

          <div class="ag-courses-item_title">
            GDSC: Formation Web Development 
          </div>

          <div class="ag-courses-item_date-box">
            Start:
            <span class="ag-courses-item_date">
              22 novembre 2023
            </span>
          </div>
        </a>
      </div>
    </div>
  </section>

  <section class="lienscont">
    <div class="liens">
      <h1 class="lienstxt">Découvrez nos liens utiles pour enrichir votre expérience et diversifier vos connaissances !</h1>
      <div class="liensliens"> 
        <ul>
        <li><a href="https://www.ummto.dz/">Notre Université</a></li>
        <li><a href="https://teleensm.ummto.dz/">E-learning</a></li>
        <li><a href="https://openclassrooms.com/fr/">Open Classrooms</a></li>
        <li><a href="https://www.udemy.com/?gad_source=1&utm=7e5d4e2cd0433c9198fadf0a5703632d&track=1&pt=2">Udemy</a></li>
        <li><a href="https://www.w3schools.com/">W3school</a></li>
      </ul>
    </div>
    </div>
  </section>

<h1 class="txt1 titreevvv">EVENEMENTS</h1>
  <section class="event">

    <div class="latest">
      <h1 class="event1">Dernières Nouvelles</h1>
      <img src="../static/img/events1.jpg" alt="" class="zoom img-eventsl">
      <p class="txtevent1">GDSC : Événement de Sensibilisation sur les dangers des réseaux sociaux.
      </p>
      <p class="dateevent">Le 08 mai 2024 à 9h30, à la Terrasse de Bastos.</p>
    </div>
    <div class="scroll-snap-card">
      <div class="slide red">
        <img src="../static/img/ev11.jpg" alt="" class="zoom imgeventsl">
        <div class="desc">
          <h1 class="titreeventsl">CSI : AI Challenge au Département Informatique 
          </h1>
          <p class="descriptionevent">Le Mardi, 07 mai 2024, À partir de 9h au Département Informatique, Bastos</p>
          <p class="tip">
            Étudiants et passionnés d'IA ! Relevez le défi Montrez vos compétences!Au programme : débat, jeu d'échecs, remise de prix</p>

        </div>

      </div>
      <div class="slide blue">
        <div class="slide red">
          <img src="../static/img/ev3.jpg" alt="" class="zoom imgeventsl">
          <div class="desc">
            <h1 class="titreeventsl">CSI : CSICTF - Capture The Flag 
            </h1>
            <p class="descriptionevent">5 mars 2024</p>
            <p class="tip">
              Hackers ! le moment tant attendu est enfin là, CSICTF fait son grand retour !
               Êtes-vous prêts à relever le défi Montrez vos talents et rejoignez-nous pour une 
               aventure palpitante ! </p>

          </div>

        </div>

      </div>
      <div class="slide green">
        <div class="slide red">
          <img src="../static/img/evconf1.jpg" alt="" class="zoom imgeventsl">
          <div class="desc">
            <h1 class="titreeventsl">CSI : Conférence sur la Sécurité des Objets Connectés 
            </h1>
            <p class="descriptionevent">2 mars 2024</p>
            <p class="tip">
              Ne manquez pas la conférence présentée par le Professeur M. Daoui sur "La sécurité des objets connectés - Failles et menaces" ! Rendez-vous à 9h30 à l'amphi A du département. </p>

          </div>

        </div>

      </div>
      <div class="slide green">
        <div class="slide red">
          <img src="../static/img/evconf.jpg" alt="" class="zoom imgeventsl">
          <div class="desc">
            <h1 class="titreeventsl">CSI : Conférence sur les Diplômes Startup 
            </h1>
            <p class="descriptionevent">1 mars 2024</p>
            <p class="tip">
              Ne manquez pas la conférence animée par MADAME AMNACHE, directrice de l'incubateur UMMTO, sur les diplômes startup, suivie d'un débat ! Rendez-vous à l'amphi A du département informatique. </p>

          </div>

        </div>

      </div>
      <div class="slide green">
        <div class="slide red">
          <img src="../static/img/ev2.jpg" alt="" class="zoom imgeventsl">
          <div class="desc">
            <h1 class="titreeventsl">GDSC : DevFest 23 - Retour en Force ! 
            </h1>
            <p class="descriptionevent">Lundi 25 décembre 2023 au département d'informatique </p>
            <p class="tip">
              Rejoignez-nous pour notre DevFest 23, présentant les dernières technologies par nos chers étudiants !Consultez l'agenda complet pour ne rien manquer !</p>

          </div>

        </div>

      </div>
    </div>
  </section>

  <section class="whyuni">
    <h1 class="genralewhy txt-1">POURQUOI CHOISIR UNIFORTECH ?</h1>
    <div class="globalwhy">
      <div class="div1why c1">
        <H1 class="whyunititre">Accès à une Richesse de Ressources Pédagogiques</H1>
        <p class="whyunip">
          Choisissez UniforTech, votre plateforme ultime pour l'apprentissage informatique ! Accédez à une multitude de ressources pédagogiques, une bibliothèque virtuelle complète offrant une vaste sélection de livres pertinents. </p>
        <button class="button btn-cntn" onclick="window.location.href='./contact.php'">
          <span class="button-text">Contactez</span>
          <div class="fill-container"></div>
        </button>
      </div>
      <div class="div1why c2">
        <h1 class="whyunititre">Restez Connectés et Collaborez Facilement</h1>
        <p class="whyunip">Restez informés des dernières nouveautés et annonces et profitez d’une communication facilitée entre étudiants. Rejoignez-nous dès maintenant et découvrez une nouvelle façon de collaborer et d'apprendre ensemble !
           </p>
        <button class="button btn-cntn"  onclick="window.location.href='./contact.php'">
          <span class="button-text">Contactez</span>
          <div class="fill-container"></div>
        </button>
      </div>
    </div>

  </section>
  <?php include('./footer.php'); ?>
</body>

</html>