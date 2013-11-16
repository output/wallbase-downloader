<?php
  require_once "http.php";
  require_once "web_browser.php";
  require_once "simple_html_dom.php";
  
  $html = new simple_html_dom();
  $url = "http://wallbase.cc/toplist?section=wallpapers&q=&res_opt=eqeq&res=0x0&thpp=32&purity=000&board=21&aspect=0.00&ts=3d";
  $web = new WebBrowser();
  
  
  $result = $web->Process($url);

  //error handling
  if (!$result["success"])
    echo "Error retrieving URL.  " . $result["error"] . "\n";
  else if ($result["response"]["code"] != 200)
    echo "Error retrieving URL.  Server returned:  " . $result["response"]["code"] . " " . $result["response"]["meaning"] . "\n";
  //actual stuff
  else
  {
    //load page body to html 'object'
    $html->load($result["body"]);
    
    //extract all urls
    $links = $html->find("a[href]");
    
    $goodlinks=array();
    
    foreach($links as $link){
      if(strpos($link->href,"http://wallbase.cc/wallpaper/")!==false)
        $goodlinks[]=$link->href;
    }
    
    foreach($goodlinks as &$gl){
      $gl=split("[\/]",$gl)[4];
    }
    
    $random = mt_rand(0,count($goodlinks));
    $used = preg_split('/\s/',trim(shell_exec('ls /home/victor/.wallpapers/old/ | grep '.$goodlinks[$random])));
    do {
        $random = mt_rand(0,count($goodlinks));
        $used = preg_split('/\s/',trim(shell_exec('ls /home/victor/.wallpapers/old/ | grep '.$goodlinks[$random])));
    } while (empty($used[0])!=1);
    
    shell_exec('wget http://wallpapers.wallbase.cc/rozne/wallpaper-'.$goodlinks[$random].'.jpg -O /home/victor/.wallpapers/lockscreen.jpg');
    shell_exec('cp /home/victor/.wallpapers/lockscreen.jpg /home/victor/.wallpapers/old/'.date('Y-m-d_H:i:s').'-wallpaper-'.$goodlinks[$random].'.jpg');
    
  }
?>
