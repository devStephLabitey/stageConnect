<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- fontfamily -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&family=Codystar:wght@300;400&family=Edu+NSW+ACT+Cursive:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-brands/css/uicons-brands.css'>
    <!-- fontfamily -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Styles/Style.css">
    <title>Acceuil StageConnect</title>
</head>

<body>
     <div class="Home">

           <div class="Navbar">
           
            <div class="navbarContent">
                
                <div class="logo">
                    
                    <a href="index.php">
                        <img src="../Assets/Images/mascot.png" alt="logo" class='mascot'/>    
                    </a>
                    
                    <a href="index.php">
                        <img src="../Assets/Images/logoLg.png" alt="logo" class='logolg'/>    
                    </a>
                    
                    
                </div>

                <div class="SectionLinks">
                    <nav>
                       <a href=""><h2>- Espace Entreprises 🏢 -</h2></a>
                    </nav>
                </div>


                <div class="authPlace">
                    <nav>
                        <a href="../Auth/Login.php" className='sgn-in'>Se Connecter</a>
                       <a href="../Auth/Entreprise_Signup.php"> <button className='btn btn-def sgn-up'>S'inscrire</button></a>
                    </nav>
                </div>
            
            </div>

        </div>



        <div class="imgEntrepsise">
            <div class="couche">
                <div class="EntrepriseContent">
                    <h2>Collaborez Avec des futurs professionnels</h2>
                    <h3>" En leurs offrant des stages "</h3>
                    <a href=""><button class="btn btn-def peachbg">Faire un recrutement</button></a>
                </div>
            </div>
        </div>

        <div class="role">
            <div class="roleContent">
                <div class="p">
                    <h1>🔹 Rôle et actions des entreprises sur la plateforme StageConnect</h1>

                    <br>
                    <hr >

                    <br><br>
                    Sur la plateforme StageConnect, les entreprises disposent d’un espace dédié leur permettant de gérer efficacement tout le cycle d’accueil des stagiaires. Une fois inscrites et validées par l’établissement, elles accèdent à un tableau de bord simplifié leur offrant plusieurs fonctionnalités clés :
                    <br><br>
                    🔸 Publication d’offres de stage : Les recruteurs peuvent soumettre des offres de stage en précisant les profils recherchés, la durée, les missions, les compétences attendues et les modalités de travail. Ces offres sont directement consultables par les étudiants de l’établissement.
                    <br><br>
                    🔸 Gestion des candidatures reçues : Lorsqu’un étudiant postule à une offre, l’entreprise peut visualiser son profil, télécharger son CV et évaluer la pertinence de sa candidature avant d’accepter ou refuser sa demande.
                    <br><br>
                    🔸 Suivi des stagiaires en cours : Une fois les stagiaires sélectionnés, l’entreprise peut suivre leur évolution via des outils intégrés. Elle a accès au journal de bord, aux rapports intermédiaires, et peut échanger directement avec les étudiants ou les tuteurs académiques.
                    <br><br>
                    🔸 Encadrement et évaluation : À la fin du stage, l’entreprise peut remplir une fiche d’évaluation en ligne afin de noter les performances, les compétences acquises et la conduite du stagiaire. Ces évaluations sont partagées avec l’établissement pour validation.
                    <br><br>
                    🔸 Historique des stages : Chaque entreprise peut consulter l’historique de ses stages passés, revoir les étudiants accueillis et dupliquer d’anciennes offres si besoin.
                    <br> <br> <br><br>
                    <b>
                    Grâce à cette interface intuitive, les entreprises gagnent en temps et en efficacité, tout en renforçant leur collaboration avec l’établissement. StageConnect devient ainsi un véritable pont entre le monde académique et professionnel, au service d’une insertion réussie des jeunes diplômés.
                    </b>                
                <hr>
                </div>
            </div>
        </div>




        <section class="newsletter-section">
            <h2>📬 Inscrivez-vous à notre newsletter</h2>
            <p>Restez informé des nouvelles offres de stage, actualités et événements de StageConnect.</p>

            <form id="newsletter-form">
              <input type="text" id="name" placeholder="Votre nom complet" required />
              <input type="email" id="email" placeholder="Votre adresse email" required />
              <button type="submit">S'inscrire</button>
            </form>
        
            <p id="message" class="hidden"></p>
          </section>
      
         



                     <footer>
                    <div class="footerContent">
                       <div class="ft-logo">
                         <div class="logo">
                            <img src="../Assets/Images/mascot.png"  class="mascot" alt="" />
                            <img src="../Assets/Images/logoLg.png" class="logolg" alt="" />
                        </div>
                       </div>

                       <div class="links">
                        <nav>
                            <a href="">Acceuil</a>
                            <a href="">A Propos</a>
                            <a href="">Fonctionnalités</a>
                            <a href="Entreprise.php">Entreprise</a>
                            <a href="Offer.php">Offres de stages <span>🔴</span></a>
                        </nav>
                    </div>
                    <div className="icons">
                       <a href=""> <i class="fi fi-brands-facebook"></i>
                        </a>
                       <a href=""> <i class="fi fi-brands-instagram"></i></a>

                        <a href=""><i class="fi fi-brands-linkedin"></i></a>
                        
                       <a href=""> <i class="fi fi-brands-twitter-alt-circle"></i></a>

                       <a href=""><i class="fi fi-brands-youtube"></i></a>
                    </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem nobis est ratione officia, placeat excepturi explicabo eaque! Necessitatibus facere culpa, optio nobis adipisci molestias qui tempore iure molestiae mollitia unde? </p>

                    </div>
                </footer>
           
        </div>

        <script>
            AOS.init();
        </script>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="../Assets/Js/Features.js"></script>
</body>
</html>