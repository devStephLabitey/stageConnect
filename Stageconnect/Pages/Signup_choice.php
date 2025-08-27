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
 <section class="Features peachbg" id="Features">
                    <div class="featureContent">
                        <div class="title-ftr">
                            <div class="tl-1">
                                <h3>StageConnect</h3>
                            </div>
                            <div class="tl-2">
                                <h1>Choisissez Votre option d'inscription</h1>
                            </div>
                            <a href="../Auth/Login.php" style="display: flex; align-items: center; justify-items: end; color: red;">Se connecter</a>
                        </div>

                    <div class="ftr-cards">
                        <div class="cards-content">
                            
                            <a href="../Auth/Signup.php" class="card cardN1" onmousemove="handleMouseMove(event, this)" onmouseleave="resetCard(this)">
                                <div class="cd-title">
                                    <h2>S'inscrire en tant qu'<span style="padding: 0vh 1vh;  color: var(--red); background: var(--white); border-radius: 1vh;">étudiants</span></h2>
                                    <div>+</div>
                                </div>
                              <hr />
                                <div class="cd-desc">
                                    Les étudiants peuvent :

                                    <ul>
                                      <li>⭐ consulter et postuler à des offres de stage</li>
                                      <li>⭐ suivre l’évolution de leur candidature</li>
                                      <li>⭐ remplir un journal de bord et échanger avec leurs encadreurs.</li>
                                    </ul>
                                </div>
                                <div class="cd-img">
                                    <img src="../Assets/Images/etudiant.jpg" alt="">
                                </div>
                            </a>
                        
                            <h1>Ou</h1>
                        
                            <a href="../Auth/Entreprise_Signup.php" class="card cardN2" onmousemove="handleMouseMove(event, this)" onmouseleave="resetCard(this)">
                                <div class="cd-title">
                                    <h2>S'inscrire en tant qu'en <span style="padding: 0vh 1vh;  color: var(--peach); background: var(--white); border-radius: 1vh;">recruteur</span></h2>
                                    <div>+</div>
                                </div>
                              <hr />
                                <div class="cd-desc">
                                    Quant aux entreprises, elles peuvent publier des offres de stage, gérer les candidatures reçues, encadrer les stagiaires, et remplir les fiches d’évaluation directement via la plateforme.
                                </div>
                                <div class="cd-img">
                                  <img src="../Assets/Images/entreprise.jpg" alt="">
                                </div>
                            </a>

                          </div>
                           </div>

                    </div>
                </section>

               

           
            </div>

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