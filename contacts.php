<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nos contacts</title>
</head>
<body>
<div class="container">
    <div class="nav">
        <img src="images/Logo.png" alt="Logo">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="entreprise.php">Notre entreprise</a></li>
            <li><a href="produits.php">Nos produits</a></li>
            <li><a href="contacts.php">Contactez-nous</a></li>
        </ul>
    </div>
    <div class="background">
    <div class="content3">
        <h2 class="title2">Besoin de nous contacter ? On est là pour vous.</h2>
        <div>
            <form action="" method="post" enctype="multipart/form-data">

                <label for="prenom">Prénom <span class="etoile">*</span></label>
                <label for="nom">Nom <span class="etoile">*</span></label>

                <input type="text" name="prenom" id="prenom" value="">
                <input type="text" name="nom" id="nom" value="">

                <label for="mail">E-mail <span class="etoile">*</span></label>
                <label for="telephone">Téléphone <span class="etoile">*</span></label>

                <input type="text" name="mail" id="mail" value="">
                <input type="text" name="telephone" id="telephone" value="">

                <label for="message" class="message">Message <span class="etoile">*</span></label>
                <textarea name="message" id="message" cols="50" rows="10"></textarea>

                <label for="">Fichier <span class="icone"><i class="fa-solid fa-circle-info"></i><span class="block">Déposez un fichier
                        si vous voulez passer une commande personnalisée. (Ex : Image du patron du dé) Taille max : 5 Mo</span></span></label>
                <div><span class="etoile">*</span> : Ce champ est obligatoire.</div>

                <input type="file" name="fichier" id="fichier">

                <input type="submit" value="Envoyer">

            </form>

            <div>
                <div class="contacter">Si vous avez des questions ou besoin d'aide, contactez-nous : </div>
                <ul class="ul">
                    <li><i class="fa-solid fa-at"></i> : <span>support.paradice@gmail.com</span></li>
                    <li><i class="fa-solid fa-phone"></i> : <span>03 84 48 97 32</span></li>
                    <li><i class="fa-solid fa-location-dot"></i> : <span>45 Boulevard commercial 25000 Besançon</span></li>
                </ul>
                <div class="horaires">
                    <div class="title">Horaires :</div>
                    <div>Lundi : Fermé</div>
                    <div>Mardi : 8:00 - 18:00</div>
                    <div>Mercredi : 8:00 - 18:00</div>
                    <div>Jeudi : 8:00 - 18:00</div>
                    <div>Vendredi : 8:00 - 18:00</div>
                    <div>Samedi : 9:00 - 17:00</div>
                    <div>Dimanche : 8:30 - 12:30</div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <footer class="footer">
        <div>
            <div><i class="fa-regular fa-copyright"></i> Paradice, Inc.</div>
            <div class="contacts">
                <a href="https://www.twitter.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="liens">
            <a href="entreprise.php">Notre entreprise</a>
            <a href="contacts.php">Contacts</a>
            <a href="#">Politique de confidentialité</a>
        </div>

        <div class="infos">
            <div>Coordonnées :</div>
            <div><i class="fa-solid fa-phone"></i> : +33 3 84 48 97 32</div>
            <div><i class="fa-solid fa-at"></i> : support.paradice@gmail.com</div>
            <div><i class="fa-solid fa-location-dot"></i> : 45 Boulevard commercial</div>
            <div>25000 Besançon</div>
        </div>
    </footer>
</div>
</body>
</html>