<html>
   
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
   <?php
      $to = "justbayr@gmail.com";
      $subject = "My subject";
      $msg = "Hello world!";
      $headers = "From: recodegeass@gmail.com";

      $smtpServer = 'ssl://smtp.gmail.com';
      $smtpPort = 465;

      $smtpConnection = stream_socket_client($smtpServer . ':' . $smtpPort, $errno, $errstr, 30);

      if ($smtpConnection === false) {
         echo "Failed to connect to the mail server. Error: $errstr ($errno)";
      } else {
         stream_set_blocking($smtpConnection, true);

         // Check if SSL/TLS encryption is already enabled
         $cryptoInfo = stream_get_meta_data($smtpConnection);
         if (!isset($cryptoInfo['crypto']) || $cryptoInfo['crypto'] !== 'ssl') {
            stream_socket_enable_crypto($smtpConnection, true, STREAM_CRYPTO_METHOD_SSLv23_CLIENT);
         }

         $isMailSent = mail($to, $subject, $msg, $headers, "-f");

         if ($isMailSent) {
            echo "Message sent successfully!";
         } else {
            echo "Message could not be sent.";
         }

         fclose($smtpConnection);
      }
   ?>
      
   </body>
</html>