<?php 

if(isset($_POST['send'])){
    require_once 'mail.php';
    $mail->setFrom('arabaucuion@gmail.com', 'Arab Auction');
    $mail->addAddress('kurdi313@gmail.com');
  //  $mail->addCC('academyshiyar@gmail.com');
    $mail->Subject = 'Active Account';
    $mail->Body    = 'The verification code is : <b>123-123</b>';
    $mail->send();
   header("Location: index.php", true);
}

?>

<form method="POST">
<button type="submit" name="send">ارسال</button>
</form>

