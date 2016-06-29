<?php
$function = htmlentities(strip_tags($_POST['function']), ENT_QUOTES);
$file = htmlentities(strip_tags($_POST['file']), ENT_QUOTES);

$log = array();

  switch ($function)
  {

     case ('getState'):

         if (file_exists($file))
         {
             $lines = file($file);
         }
           $log['state'] = count($lines);

         break;

     case ('send'):

     console.log('this is process');

       $nickname = htmlentities(strip_tags($_POST['nickname']), ENT_QUOTES);
       $patterns = array("/:\)/", "/:D/", "/:p/", "/:P/", "/:\(/","/:O/","/aew/");
       $replacements = array("<img src='images/vj1.jpg'/>", "<img src='smiles/bigsmile.png'/>", "<img src='smiles/tongue.png'/>", "<img src='smiles/tongue.png'/>", "<img src='images/vj.jpg'/>", "<img src='images/marc.jpg'/>", "<img src='images/mors.jpg'/>");
       $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
       $blankexp = "/^\n/";
       $message = htmlentities(strip_tags($_POST['message']), ENT_QUOTES);

       if (!preg_match($blankexp, $message)) {

         if (preg_match($reg_exUrl, $message, $url)) {
              $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
         }
         $message = preg_replace($patterns, $replacements, $message);

$now = Time();
$now = date( 'h:i d.m.Y', $now );
                     	 fwrite(fopen($file, 'a'), "<strong>". $nickname . ":</strong>" ."<p class='pull-right'>".$now."</p>". $message = str_replace("\n", " ", $message)."<hr style='border: 0;height: 1px;background: #333;background-image: linear-gradient(to right, #ccc, #333, #ccc);'>". "\n");}

         break;

  }

  echo json_encode($log);
  ?>
