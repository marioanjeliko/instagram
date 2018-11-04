<?php
/*Pastikan Akun Tidak Privat*/
$username="Your Instagram Username";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.instagram.com/".$username."/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if($http=="200") {
  $doc = new DOMDocument();
  $doc->loadHTML($result);
  $xpath = new DOMXPath($doc);
  $js = $xpath->query('//body/script[@type="text/javascript"]')->item(0)->nodeValue;
  $start = strpos($js, '{');
  $end = strrpos($js, ';');
   $json = substr($js, $start, $end - $start);
  $data = json_decode($json, true);
  print_r($data);
  foreach($data["entry_data"]["ProfilePage"][0]["graphql"]["user"]["edge_owner_to_timeline_media"]["edges"] as $hasil) {
  		//echo $hasil["node"]["edge_media_to_caption"]["edges"][0]["node"]["text"]."<br>";
  		//echo $hasil["node"]["thumbnail_src"]."<br>";
  		//echo $hasil["node"]["shortcode"]."<br>";
  } 
}  