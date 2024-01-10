
<!--  l'appel d'une fonction 
bien précise pour disposer d'une session : session_start().
uilité : démarrer une session sur le serveur pour l'utilisateur 
courant, ou récupérer la session de ce même utilisateur s'il en avait déjà une. 

<?php
session_start();

switch($_GET["action"]) {
    case "ajouterProduit": 
        
        if(isset($_POST['submit'])){
    
        $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
    /*La fonction PHP filter_input() permet d'effectuer une validation ou 
    un nettoyage de chaque donnée transmise par le formulaire en employant divers filtres
    
    FILTER_SANITIZE_STRING (champ "name") : ce filtre supprime une chaîne de 
    caractères de toute présence de caractères spéciaux et de toute balise HTML 
    potentielle ou les encode. Pas d'injection de code HTML possible !
    
    FILTER_VALIDATE_FLOAT (champ "price") : validera le prix que s'il est un nombre à 
    virgule (pas de texte ou autre…), le drapeau FILTER_FLAG_ALLOW_FRACTION est 
    ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.
    
    FILTER_VALIDATE_INT (champ "qtt") : ne validera la quantité que si celle-ci est un 
    nombre entier différent de zéro (qui est considéré comme nul).*/
    
        if($name && $price && $qtt){
    
    /*tableau associatif*/ 
            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt
            ];
    
            $_SESSION['products'][] = $product;
        }
    }
    
        break;

    case "viderPanier": 
        unset($_SESSION['products']);
        header("location:recap.php");


        break;
   

case "supprimerProduit":

         $index = $_GET['id'];
        unset($_SESSION['products'][$index]);
            
        break;       

case "augmenterQtt":

        $index = $_GET['id'];
        $_SESSION['products'][$index]['qtt']++;
            
        break;

case "diminuerQtt":
            
        $index = $_GET['id'];
        $_SESSION['products'][$index]['qtt']--;
                
        break;

}
/* limiter l'accès à traitement.php par les seules requêtes HTTP 
provenant de la soumission de notre formulaire.
Pour cela, une condition simple doit être effectuée :*/
if(isset($_POST['submit'])){
    
    $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
/*La fonction PHP filter_input() permet d'effectuer une validation ou 
un nettoyage de chaque donnée transmise par le formulaire en employant divers filtres

FILTER_SANITIZE_STRING (champ "name") : ce filtre supprime une chaîne de 
caractères de toute présence de caractères spéciaux et de toute balise HTML 
potentielle ou les encode. Pas d'injection de code HTML possible !

FILTER_VALIDATE_FLOAT (champ "price") : validera le prix que s'il est un nombre à 
virgule (pas de texte ou autre…), le drapeau FILTER_FLAG_ALLOW_FRACTION est 
ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.

FILTER_VALIDATE_INT (champ "qtt") : ne validera la quantité que si celle-ci est un 
nombre entier différent de zéro (qui est considéré comme nul).*/

    if($name && $price && $qtt){

/*tableau associatif*/ 
        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price*$qtt
        ];

        $_SESSION['products'][] = $product;
    }
}


header("location:recap.php");
/* la fonction header("Location:…") :
Cette fonction envoie un nouvel entête HTTP (les entêtes d'une réponse) au client. Avec le 
type d'appel "Location:", cette réponse est envoyée au client avec le status code 302, qui 
indique une redirection. Le client recevra alors la ressource précisée dans cette fonction*/ 