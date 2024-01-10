<?php
    session_start();
?>
<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-widht, initial-scale=1.0">

    <title> Récapitulatif des produits</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



<nav>

    <a href="index.php">Ajouter un produit</a>

    <a href="recap.php">Nombre Produit <?php echo count($_SESSION['products'] ?? []); ?></a> 
    
    <!--- count($_SESSION['products'] ?? []) utilise l'opérateur de fusion null.
     S'il y a une clé products dans la session, il utilise le tableau associé, sinon, il utilise un tableau vide [].-->

</nav>
   

    <?php 

    
    
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){      /*Nous rajoutons une condition qui vérifie :
                                                                             Soit la clé "products" du tableau de session $_SESSION n'existe pas : !isset()
                                                                            Soit cette clé existe mais ne contient aucune donnée : empty()
                                                                            Dans ces deux cas, nous afficherons à l'utilisateur un message le prévenant qu'aucun 
                                                                            produit n'existe en session. Il ne nous reste plus qu'à afficher le contenu de 
                                                                             $_SESSION['products'] dans la partie else de notre condition.
                                                                            */
        echo "<p> Aucun produit en session...</p>";
    }


    else{             /*initialise correctement un tableau HTML avec une ligne d'en-têtes <thead>, afin de bien décomposer les données de 
        chaque produit.*/
        echo "<table>",                                             
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Enlever</th>",
                        "<th>Prix</th>",
                        "<th>Ajouter</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                        "<th>supprimer</th>",
                 "</tr>",
                "</thead>",
                "<tbody>";

        $totalGeneral = 0; /* avant la boucle, on initialise une nouvelle variable $totalGeneral à zéro. */
        foreach($_SESSION['products'] as $index => $product){ /*nous observons la boucle itérative foreach()4 de PHP, particulièrement efficace 
                                                                pour exécuter, produit par produit, les mêmes instructions qui vont permettre l'affichage 
                                                                uniforme de chacun d'entre eux. 
        Pour chaque donnée dans $_SESSION['products'], nous 
            disposerons au sein de la boucle de deux variables :
    */
    
    
            echo "<tr>",
                    "<td>".$index."</td>", /*$index : aura pour valeur l'index du tableau $_SESSION['products'] parcouru. Nous pourrons numéroter ainsi chaque produit avec ce numéro dans le tableau HTML (en 
                    première colonne)*/
                    "<td>".$product['name']."</td>",  /* $product : cette variable contiendra le produit, sous forme de tableau, tel que l'a créé 
                    et stocké en session le fichier traitement.php.*/
                    
                    "<td><a href='traitement.php?action=diminuerQtt&id=$index'> - </a></td>",
                    "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>", /*La fonction PHP number_format() permet de modifier l'affichage d'une valeur numérique 
                                                                                            en précisant plusieurs paramètres :
                                                                                            number_format(
                                                                                            variable à modifier, 
                                                                                            nombre de décimales souhaité, 
                                                                                            caractère séparateur décimal,
                                                                                            caractère séparateur de milliers5*/
                     "<td><a href='traitement.php?action=augmenterQtt&id=$index'> + </a></td>",
                    "<td>".$product['qtt']."</td>",
                    "<td>".number_format($product['price'] * $product['qtt'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?action=supprimerProduit&id=$index'>Supprimer</a></td>",
                "</tr>";
            $totalGeneral+=$product['total']; 
    
            /* À l'intérieur de la boucle, grâce à l'opérateur combiné +=, on ajoute le total du produit 
            parcouru à la valeur de $totalGeneral, qui augmente d'autant pour chaque produit6
            Une autre syntaxe est, là encore, possible : $totalGeneral = $totalGeneral + $produit["total"]*/
              
        }
        echo "<tr>",
                "<td colspan=4>Total général : </td>",
                "<td><strong>".number_format($totalGeneral, 2,",", "&nbsp;")."&nbsp;€</strong></td>",
            "</tr>",
                /* Une fois la boucle terminée, nous affichons une dernière ligne avant de refermer notre 
    tableau. Cette ligne contient deux cellules : une cellule fusionnée de 4 cellules (colspan=4) 
    pour l'intitulé, et une cellule affichant le contenu formaté de $totalGeneral avec 
    number_format( */
                
            "</tbody>
        </table>";
    }

    ?>

    <a href="traitement.php?action=viderPanier"> Vider le panier </a>
    
</body>
</html>