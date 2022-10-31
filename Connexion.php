<?php
if (
    (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    || (!isset($_POST['mdp']) || empty($_POST['mdp']))
    )
{
	echo('Il faut un email et un mdp valides pour soumettre le formulaire.');
    return;
}else{
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Site de Recettes - Demande de contact reçue</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body>
        <div class="container">
                <h1>mdp bien reçu !</h1>
            
            <div class="card">
                
                <div class="card-body">
                    <h5 class="card-title">Rappel de vos informations</h5>
                    <p class="card-text"><b>Email</b> : <?php echo($email); ?></p>
                    <p class="card-text"><b>mdp</b> : <?php echo strip_tags($mdp); ?></p>
                </div>
            </div>
        </div>
    </body>
</html>