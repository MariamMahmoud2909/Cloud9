<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud9</title>
  </head>
  <body>
    <?php echo 'blabaalalallla' ;
    
    $scan = scandir('E:\xampp\htdocs\Cloud9');
foreach($scan as $file) {
   if (!is_dir("myFolder/$file")) {
      echo $file.'<br>';
   }
}?>
  </body>
</html>