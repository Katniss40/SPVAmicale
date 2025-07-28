<?php
/* Récupération des informations du formulaire*/
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 $name = stripslashes(trim($_POST['name']));
 $surname = stripslashes(trim($_POST['surname']));
 $telephone = stripslashes(trim($_POST['telephone']));
 $mail = stripslashes(trim($_POST['email']));
 $motif = stripslashes(trim($_POST['subject']));
 $message = stripslashes(trim($_POST['message']));
}     
else      
{
 $nom = trim($_POST['name']);
 $prenom = trim($_POST['surname']);
 $telephone = trim($_POST['telephone']);
 $mail = trim($_POST['email']);
 $motif = trim($_POST['subject']);
 $message = trim($_POST['message']);
}
/*Vérifie si l'adresse mail est au bon format */
 $regex_mail = '/^[-+.w]{1,64}@[-.w]{1,64}.[-.w]{2,6}$/i'; 
 /*Verifie qu il n y est pas d en tête dans les données*/
$regex_head = '/[nr]/';   
/*Vérifie qu il n y est pas d erreur dans adresse mail*/
 if (!preg_match($regex_mail, $mail))
 {
 $alert = 'L\'adresse '.$mail.' n\'est pas valide';      
 }
 else
{ 
 $courriel = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $courriel = 0;
}     
/* On vérifie qu'il n'y a aucun header dans les champs */ 
if (preg_match($regex_head, $name)
 || preg_match($regex_head, $surname)
 || preg_match($regex_head, $telephone)
 || preg_match($regex_head, $email)
 || preg_match($regex_head, $subject)
 || preg_match($regex_head, $message))
{  
 $alert = 'En-têtes interdites dans les champs du formulaire'; 
}
else
{ 
 $header = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $header = 0;
}
if (empty($telephone) 
 || empty($name) 
 || empty($message))
{  
 $alert = 'Tous les champs doivent être renseignés';
} 
else
{  
 $renseigne = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $renseigne = 0;
}
/* Si les variables sont bonne */
if ($renseigne == 1 AND $header == 1 AND $courriel == 1)
{
/*Envoi du mail*/

/*Le destinataire*/
$to="demo@fafa-informatique.com";

/*Le sujet du message qui apparaitra*/
$sujet="Message depuis le site";
$msg = '';
/*Le message en lui même*/
/*$msg = 'Mail envoye depuis le site' "rnrn";*/
$msg .= 'name : '.$name."rnrn";
$msg .= 'Prenom : '.$surname."rnrn";
$msg .= 'Telephone : '.$telephone."rnrn";
$msg .= 'eMail : '.$mail."rnrn";
$msg .= 'subject : '.$motif."rnrn";
$msg .= 'Message : '.$message."rnrn";
/*Les en-têtes du mail*/
$headers = 'From: MESSAGE DU SITE FAFA'."rn";
$headers .= "rn";
/*L'envoi du mail - Et page de redirection*/
mail($to, $subject, $msg, $headers);
header('Location:"\"');
}
else
{
header('Location:"\"');
}
?>
