<!doctype html>
<html>
   <head>
      <title>Mirror Bot</title>
   </head>
   <body>
<?php 
      $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
      $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
      echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';
?>
   <script>
   function php_data(){
      let php_data=<?php echo json_encode($_SERVER);?>;
      return php_data;
   }
   let data=php_data();
   </script>
   </body>
</html>
