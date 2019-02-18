<?php
include "main.php";
include "mail.php";
?>

<html>
<head>
<title>Web crawler</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<form method="get" action="main.php">
<p style="text-align:center;"><input type="text" name="target" class="input" /></p>
<p style="text-align:center;"><input type="submit" name="crawl" class="button" value="Submit" /></p>
</form>
    
   <?php
    if(isset($_GET['crawl'])){
        $to = "ernestasvvv@gmail.com";
  
      $subject = "This is subject";
  
      $message = "This is test message.";
  
      # Open a file
      $file = fopen( "results.txt", "r" );
  
      if( $file == false )
      {
     
        echo "Error in opening file";
     
        exit();
        
      }
      
      # Read the file into a variable
      $size = filesize("results.txt");
  
      $content = fread( $file, $size);
      # encode the data for safe transit
      # and insert \r\n after every 76 chars.
      $encoded_content = chunk_split( base64_encode($content));
  
      # Get a random 32 bit number using time() as seed.
      $num = md5( time() );
      # Define the main headers.
      $header = "From:ernestasvvv@gmail.com\r\n";
  
      $header .= "MIME-Version: 1.0\r\n";
  
      $header .= "Content-Type: multipart/mixed; ";
      $header .= "boundary=$num\r\n";
  
      $header .= "--$num\r\n";
      # Define the message section
      $header .= "Content-Type: text/plain\r\n";
  
      $header .= "Content-Transfer-Encoding:8bit\r\n\n";
  
      $header .= "$message\r\n";
  
      $header .= "--$num\r\n";
      # Define the attachment section
      $header .= "Content-Type:  multipart/mixed; ";
  
      $header .= "name=\"results.txt\"\r\n";
  
      $header .= "Content-Transfer-Encoding:base64\r\n";
  
      $header .= "Content-Disposition:attachment; ";
  
      $header .= "filename=\"results.txt\"\r\n\n";
  
      $header .= "$encoded_content\r\n";
  
      $header .= "--$num--";
    
      $retval = mail ( $to, $subject, "", $header );
      if( $retval == true )
      {
      
        echo "Message sent successfully...";
      
      }
      else
      {
      
        echo "Message could not be sent...";
      
      }
    }
    
      
    
    ?>    
</body>
</html>