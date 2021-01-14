<?php
$metaTitle = "Formulaire de contact";
$metaDescription = "Contactez moi via ce formulaire";

$demande = filter_input(INPUT_POST, 'demande', FILTER_SANITIZE_STRING);
$civilite = filter_input(INPUT_POST, 'civilite', FILTER_SANITIZE_STRING);
$nom = filter_input(INPUT_POST, 'user_name1', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'user_name2', FILTER_SANITIZE_STRING);
$mail = filter_input(INPUT_POST, 'user_mail', FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
$message = filter_input(INPUT_POST, 'user_message', FILTER_SANITIZE_STRING);
$submit = filter_input(INPUT_POST, 'submit');

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d-H-i-s");
$dossierformulaire = 'contact/contact_' . $date . '.txt';

$errordemande=false;
$errorcivilite=false;
$errornom=false;
$errorprenom=false;
$errormail=false;
$errormsg=false;

$msgerrordemande = "Veuillez renseigner la nature de votre demande*";
$msgerrorcivilite = "Veuillez renseigner votre civilité*";
$msgerrornom = "Veuillez saisir votre nom*";
$msgerrorprenom = "Veuillez saisir votre prénom*";
$msgerrormail = "Veuillez saisir votre adresse e-mail*";
$msgerrormsg = "Veuillez saisir votre message*";

$formulairecomplet = true;

// Si on appuie sur le bouton "Envoyer le message"
if (isset($submit)) {
    // Si le champs 'demande' est vide
    if (empty($demande)) {
        // Le formulaire n'est pas complet
        $formulairecomplet = false;
        $errordemande=true;
    }
    if (empty($civilite)) {

        $formulairecomplet = false;
        $errorcivilite=true;
    }
    if (empty($nom)) {

        $formulairecomplet = false;
        $errornom=true;
    }
    if (empty($prenom)) {


        $formulairecomplet = false;
        $errorprenom=true;
    }
    if (empty($mail)) {

        $formulairecomplet = false;
        $errormail=true;
    }
    if (empty($message)) {
        $formulairecomplet = false;
        $errormsg=true;
    }
    // Si le formulaire est complet, alors on envoie les données dans notre fichier texte
    if ($formulairecomplet == true) {
        file_put_contents($dossierformulaire, $demande, FILE_APPEND);
        file_put_contents($dossierformulaire, $civilite, FILE_APPEND);
        file_put_contents($dossierformulaire, $nom, FILE_APPEND);
        file_put_contents($dossierformulaire, $prenom, FILE_APPEND);
        file_put_contents($dossierformulaire, $mail, FILE_APPEND);
        file_put_contents($dossierformulaire, $message, FILE_APPEND);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<main>
    <div id="entier">
        <section class="formulaire">
            <form action="/index.php?page=contact" method="POST">
                <section class="question">
                    <p>Quelle est la nature de votre demande?</p>
                    <div style="color:red";>
                    <?php
                    if ($errordemande==true) {
                        echo $msgerrordemande;
                    }
                    ?></div>
                    <div>
                        <input type="radio" id="demande" name="demande" value="Proposition d'emploi">
                        <label for="demande">Propostion d'emploi</label>
                    </div>

                    <div>
                        <input type="radio" id="demande" name="demande" value="Demande d'informations">
                        <label for="demande">Demande d'informations</label>
                    </div>
                    <div>
                        <input type="radio" id="demande" name="demande" value="Demande de prestations">
                        <label for="demande">Prestations</label>
                    </div>
                </section>

                <div style="color:red";>
                    <?php
                    if ($errorcivilite==true) {
                        echo $msgerrorcivilite;
                    }
                    ?></div><label>
                    <select name="civilite">
                        <option value=""></option>
                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>
                    </select></label>
                <div style="color:red";>
                <?php
                if ($errornom==true) {
                    echo $msgerrornom;
                }
                ?></div>
                <div>
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="user_name1">
                </div>
                <div style="color:red";>
                <?php
                if ($errorprenom==true) {
                    echo $msgerrorprenom;
                }
                ?></div>
                <div>
                    <label for="name">Prénom :</label>
                    <input type="text" id="name" name="user_name2">

                </div><div style="color:red";>
                <?php
                if ($errormail==true) {
                    echo $msgerrormail;
                }
                ?></div>
                <div>
                    <label for="mail">E-mail :</label>
                    <input type="email" id="mail" name="user_mail">

                </div><div style="color:red";>
                <?php
                if ($errormsg==true) {
                    echo $msgerrormsg;
                }
                if (strlen($message) >0 && strlen($message) <5){
                    echo "Votre message doit contenir au moins 5 lettres*";
                }
                ?></div>
                <div>
                    <label for="msg">Message :</label>
                    <textarea id="msg" name="user_message"></textarea>

                </div>
                <div class="button">
                    <button type="submit" name="submit">Envoyer le message</button>
                </div>
            </form>
        </section>
    </div>
</main>

</html>