<html>
<script>function php_data(){
var php_data=<?echo json_encode($_SERVER);?>;
return php_data;
}	var data=php_data();
</script>

   <body>
      <?php 
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';
      ?>
   </body>
</html>
