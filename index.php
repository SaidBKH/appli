



<!--
    Le terme "superglobales" signifie que ces variables sont disponibles dans n'importe quel
script PHP : autrement dit, il est inutile de vérifier si elles existent

$_GET
Liée à la méthode HTTP GET, contient tous les paramètres ayant été transmis au serveur 
par l'intermédiaire de l'URL de la requête.

$_POST
Liée à la méthode HTTP POST, contient toutes les données transmises au serveur par 
l'intermédiaire d'un formulaire (Form Data ou Request Body Parameters).

$_COOKIE
Contient les données stockées dans les cookies du navigateur client.

$_REQUEST
Regroupe les données transmises par les trois superglobales $_GET, $_POST et $_COOKIE.

$_SESSION
Contient les données stockées dans la session utilisateur côté serveur (si cette session a été 
démarrée au préalable).-->



<!DOCTYPE html>
<html lang='en'>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="widht=device-widht, initial-scale=1.0">
            <title>Ajout produit</title>
            <link rel="stylesheet" href="style.css">
        </head>

        <body>
            <nav>
                <a href="recap.php">Panier</a>
                <a href="recap.php">Nombre Produit <?php echo count($_SESSION['products'] ?? []); ?></a> 
            </nav>
    
            <?php
       session_start();
     
       
       ?>
            <h1>Ajouter un produit</h1>
            <form action="traitement.php?action=ajouterProduit" method="post"> 
 <!--- action (qui indique la cible du formulaire, le fichier à atteindre lorsque l'utilisateur soumettra le formulaire)
method (qui précise par quelle méthode HTTP les données du formulaire seront transmises au serveur)------>

                <p>
                    <label>
                        Nom du produit:
                        <input type="text" name= "name">
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit :
                        <input type="number" step="any" name="price" > 
<!--Chaque input dispose d'un attribut "name", ce qui va permettre à la requête de classer le 
contenu de la saisie dans des clés portant le nom choisi-->
                    </label>
                </p>
                <p>
                    <label>
                        Quantité desirée :
                        <input type="number" name="qtt" value="1">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit">
                </p>
            </form>
            
        </body>
</html> 