<?php 
   $data['discord']['url']='https://discord.gg/3mvFaCF';
   $data['discord']['text']='/r/PublicFreakout Discord';
   $data['server'] = $_SERVER;
   $data['ee']='https://mirrorbot.ga/no_media.jpg';
   $data['url'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
   $data['escaped_url'] = htmlspecialchars($data['url'], ENT_QUOTES, 'UTF-8');
   $data['uri']=$_SERVER['REQUEST_URI'];
   $data['uri_arr'] = explode('/', $data['uri']);
   $data['uri_arr_count'] = count($data['uri_arr']);
   $data['urlinfo'] = redditid($data);
   $data['id'] = $data['urlinfo']['id'];
   $data['description'] = $data['urlinfo']['description'];
   $data['video']['file']=$data['id'].'.mp4';
   $data['video']['scheme']='https://mirrorbot.ga/media/';
   $data['video']['url']=$data['video']['scheme'].$data['video']['file'];
   $data['video']['image_url']='https://mirrorbot.ga/video_background.png';
   $data['redditurl'] = 'https://www.reddit.com/'.$data['id'].'/';
   if (empty($data['id'])) {
      $data['short_url']='';
      $data['title']='/r/PublicFreakout Mirror Bot';
      $data['video_player']='';
   }else{
      $data['short_url'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$data['id'].'/';
      $data['title']='/r/PublicFreakout Mirror Bot - Video ID:'.$data['id'];
      $data['video']['player']=videoplayer($data);
   }
   function redditid($data){
      $short=3;
      $long=7;
      if($data['uri_arr_count']==$short){//for uris that look like this: '/8whh7h/'
         $id=$data['uri_arr'][1];
      }elseif($data['uri_arr_count']==$long){//for uris that look like this: '/r/PublicFreakout/comments/8whh7h/too_drunk_for_a_piss/'
         $id=$data['uri_arr'][4];
         $description=htmlspecialchars(ucfirst(str_replace('_', ' ', $data['uri_arr']['5'])), ENT_QUOTES, 'UTF-8');
      }else{
         $id='';
      }
      $return['id']=$id;
      if(isset($description)){
         $return['desciption']=$description;
      }else{
         $return['description']='';
      }
      return $return;
   }
   function videoplayer($data){
      return'<video id="videoPlayer" class="video-js" controls autoplay preload="auto" width="60%" height="35%" poster="'.$data['video']['image_url'].'" data-setup="{"autoplay": true, "controls": true}">
          <source src="'.$data['video']['url'].'" type="video/mp4">
          <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading to a web browser that
            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
          </p>
      </video>';
   }
?>
<!doctype html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php echo '<title>'.$data['title'].'</title>'; ?>
      <link href="https://vjs.zencdn.net/7.0.5/video-js.css" rel="stylesheet">
      <style type="text/css">
      html{
         min-height:100%;
         min-width:100%;
      }
      body{
         max-width: 100%;
         overflow-x: hidden;
         margin: 0 auto;
         font: 14px/1.5 "OpenSansRegular", "Helvetica Neue", Helvetica, Arial, sans-serif;
         color: #f0e7d5;
         font-weight: normal;
         background: #252525;
         background-attachment: fixed;
         background: linear-gradient(#2a2a29, #1c1c1c);
         text-align: center;
         margin-top: 10px;
       }
       .video-js{
         margin:0 auto;
         width:800px;
         max-width: 100%;
         min-height:500px;
       }
       .video-js,
       .vjs-poster{
         background-color:transparent;
       }
       a:link,
       a:active,
       a:visited,
       a:hover{
         color:inherit;
       }
       .ee{
         width:600px;
         max-width:100%;
         margin:0 auto;
         padding:0;
       }
        </style>

      <!-- Chromecast support (not yet implemented) -->
      <!--
      <head data-cast-api-enabled="true"> 
      <script src="http://www.gstatic.com/cv/js/sender/v1/cast_sender.js"></script>
      <script src="/usr/local/lib/node_modules/videojs-chromecast/dist/videojs-chromecast.js"></script>
      -->
      
      <script src="https://vjs.zencdn.net/7.0.5/video.js"></script>
      <script src="/ready.min.js"></script>
   </head>
   <body>
         <?php
            if (!empty($data['id'])) {
               echo $data['video']['player'];
            }
            echo '<h1>'.$data['title'].'</h1>';
            if(!empty($data['description'])){
               echo '<h2>'.$data['description'].'</h2>';
                } 
            if (!empty($data['id'])) {
               echo '<p>Permalink: <a href="' . $data['escaped_url'] . '" target="_blank" rel="noopener">' . $data['escaped_url'] . '</a></p>';
               echo '<p>Short Permalink: <a href="' . $data['short_url'] . '" target="_blank" rel="noopener">' . $data['short_url'] . '</a></p>';
               echo '<p>Reddit Post: <a href="' . $data['redditurl'] . '" target="_blank" rel="noopener">' . $data['redditurl'] . '</a></p>';
            }else{
               echo"<h2>Sorry We don't have a mirror for this.</h2>";
               echo"<img class='ee' src='".$data['ee']."' alt='/r/PublicFreakout'>";
            }
            echo '<p><a href="' . $data['discord']['url'] . '" target="_blank" rel="noopener">' . $data['discord']['text'] . '</a></p>';
            echo '<p><a href="https://www.reddit.com/r/PublicFreakout" target="_blank" rel="noopener">Back to /r/PublicFreakout</a></p>';
            echo '<p><small>DMCA: dmca@mirrorbot.ga | Anything else: admin@mirrorbot.ga</small></p>';
         ?>
      <script>
      function php_data(){
         let php_data=<?php echo json_encode($data);?>;
         return php_data;
      }
      let data=php_data();
      </script>
   </body>
</html>
