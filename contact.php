<?php

$email = $_POST["email"] ?? null;
$subject = $_POST["subject"] ?? null;
$message = $_POST["message"] ?? null;
$samplePostForm = $_POST["samplePostForm"] ?? null;
$errors = [];
const MAIL_REGEX = "/^[\w\-.]+@([\w-]+\.)+[\w-]{2,4}$/";


function isMailValid($email)
{
    global $errors;

    if (!isset($email)) {
        $mailError = [
            "type" => "email",
            "message" => "Veuillez entrer un e-mail valide",
        ];
        array_push($errors, $mailError);
        return;
    }


    switch (preg_match(MAIL_REGEX, $email)) {
        case 1:
            break;
        case 0:
            $mailError = [
                "type" => "email",
                "message" => "Veuillez entrer un e-mail valide",
            ];
            array_push($errors, $mailError);
            break;
        default:
            $regexError = [
                "type" => "regex",
                "message" => "Veuillez entrer un regex valide",
            ];
            var_dump($regexError);
            die();
            break;
    }
}
function isSubjectValid($subject)
{
    global $errors;
    if(!isset($subject)){
        $subjectError = [
            "type" => "subject",
            "message" => "Veuillez entrer un sujet",
        ];
        array_push($errors,$subjectError);
        return;
    }
    if (strlen($subject) < 3) {
        $subjectError = [
            "type" => "subject",
            "message" => "Veuillez entrer un sujet de plus de 3 caractères"
        ];
        array_push($errors,$subjectError);
        return;
    }
    elseif(strlen($subject) > 50){
        $subjectError = [
            "type" => "subject",
            "message" => "Veuillez entrer un sujet de moins de 50 caractères"
        ];
        array_push($errors,$subjectError);
        return;
    }
}
function isMessageValid($message)
{
    global $errors;
    if(!isset($message)){
        $messageError = [
            "type" => "message",
            "message" => "Veuillez entrer un message",
        ];
        array_push($errors,$messageError);
        return;
    }
    if (strlen($message) < 3) {
        $messageError = [
            "type" => "message",
            "message" => "Veuillez entrer un message de plus de 3 caractères"
        ];
        array_push($errors,$messageError);
        return;
    }
    elseif(strlen($message) > 50){
        $messageError = [
            "type" => "message",
            "message" => "Veuillez entrer un message de moins de 50 caractères"
        ];
        array_push($errors,$messageError);
        return;
    }
}

if (isset($samplePostForm)) {
    isMailValid($email);
    isSubjectValid($subject);
    isMessageValid($message);
    if(count($errors) === 0){
        $email = null;
        $subject = null;
        $message = null;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        font-size: 1.3rem;
    }

    body{
        background: antiquewhite;
        display:flex;
        flex-direction: column;
    }
    form{
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        margin-top: 200px;
    }

    input{
        width: 500px;
        border: none;
        min-height: 50px; 
        border-radius: 15px;
    }
    
    button{
        width: 500px;
        border: none;
        min-height: 50px;         
        border-radius: 15px;
    }
    h1{
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
        font-size: 3em;
    }
    ul{
        list-style:none;
        color:red;
        padding-bottom: 15px;
    }
    li{
        font-size: 0.8rem;
    }
    div{
        display:flex;
        flex-direction: column;
    }
    a{
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 2rem;
        padding:50px;
        text-decoration: none;
    }
    </style>
</head>
<body>

    <!-- AJOUTER UNE BARRE DE NAVIGATION -->
    

    <!-- ... -->


    <!-- FORMULAIRE DE CONTACT -->
    <div>
        <form action="" method="post">
    
            <label for="email">E-mail</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ""); ?>">
            <?php
            foreach($errors as $error):
                echo $error["type"] === "email" ? "<ul><li>" . $error["message"]  . "</li></ul>" : "";
            endforeach;
            ?>
            <label for="subject">Subject</label>
            <input type="text" name="subject" value="<?php echo htmlspecialchars($subject ?? ""); ?>">
            <?php
                foreach($errors as $error):
                    echo $error["type"] === "subject" ? "<ul><li>" . $error["message"]  . "</li></ul>" : "";
                endforeach;
            ?>
            <label for="message">Message</label>
            <textarea name="message" id="message" value="<?php echo htmlspecialchars($message ?? ""); ?>"></textarea>
            <?php
                foreach($errors as $error):
                    echo $error["type"] === "message" ? "<ul><li>" . $error["message"]  . "</li></ul>" : "";
                endforeach;
            ?>
            <input type="hidden" name="samplePostForm">
            <input type="submit" value="Send">
        </form>
    </div>
</body>
</html>