<?php

function mail_attachment($mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);

    $header = "From: ".$from_name." <".$from_mail.">\n";
    $header .= "Reply-To: ".$replyto."\n";
    $header .= "MIME-Version: 1.0\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\n\n";
    $emessage= "--".$uid."\n";
    $emessage.= "Content-type:text/plain; charset=iso-8859-1\n";
    $emessage.= "Content-Transfer-Encoding: 7bit\n\n";
    $emessage .= $message."\n\n";
    $emessage.= "--".$uid."\n";
    $emessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\n"; // use different content types here
    $emessage .= "Content-Transfer-Encoding: base64\n";
    $emessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\n\n";
    $emessage .= $content."\n\n";
    $emessage .= "--".$uid."--";

    
    if (mail($mailto,$subject,$emessage,$header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
    
}


$my_file = "foto.png"; // puede ser cualquier formato
$my_path = $_SERVER['DOCUMENT_ROOT']."/img/";
$my_name = "Tu nombre";
$my_mail = "hola@mail.com";
$my_replyto = "pwrethernet@gmail.com";
$my_subject = "Una imagen";
$my_message = "Esta es la imagen enviada";
$destination =  "aa.antonio.delgado@gmail.com"
mail_attachment($my_file, $my_path, $destination, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);

echo mail_attachment($destination, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);

?>