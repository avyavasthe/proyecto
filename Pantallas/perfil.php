<!DOCTYPE html>
<html>
  <head>
     <?php require_once('frag/head.php');


          if (!isset($_COOKIE['id'])) {
            header('location: index.php');
            exit;


          }

     ?>
    <title>Isol .Perfil.</title>

  </head>
  <body >

        <?php
   require_once('frag/header-logged.php');
      require_once('frag/perf.php');
        require_once('frag/footer.php'); ?>


  </body>
  </html>
