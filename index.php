<?php
include('config.php');
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}
////////////////////////////////////
   function page_title($url) {
        $fp = file_get_contents($url);
        if (!$fp) 
            return null;
        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        if (!$res) 
            return null; 
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
    }

$ip = get_client_ip_env();
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Simple URL Shorter</title>
        <link rel="stylesheet" href="styles.css">
		<link rel="stylesheet" href="https://dl6fh5ptkejqa.cloudfront.net/d4152f9bdc4b2aa91489dd560a2cd031.css">
		<link rel="shortcut icon" href="https://www.reebok.com.ar/static/on/demandware.static/Sites-Reebok-AR-Site/-/default/dwa50e74a3/images/favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
		<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>
        <section class="content">
				<header class="main-header"><h2><a href="/"><font color="#B72B2B">SIMPLE URL SHORTENER</font></a></h2></header>
				<div class="box bg-1">
				<center>
<h1><font color="#B72B2B"><b>How to use</b></font>: Put a long URL and the website will short it for you.</h1>
</center>
				</div>
				<div class="box bg-2">
					<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(empty($_POST['submit'])){
?>
<div id="form_container" class="t-center mid-container foot-room">
<form method="post">
<fieldset class="cf">
<input id="shorten_url" taborder="1" name="url" type="text" class="shorten-input" placeholder="Paste a link to shorten it" value="" autocomplete="off" autocorrect="off" autocapitalize="off" />
<input id="shorten_btn" type="submit" class="button button-primary button-large shorten-button" value="Shorten" name="submit" style="background: #4E4D4D;" />
</fieldset>
</form>
</div>
<?php
}else{
$url = mysqli_real_escape_string($con, $_POST['url']);
$string = generateRandomString();
/*
function getUserIP() {
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}*/

///////////////////
$consult = $con->query("SELECT * FROM urls WHERE ip='$ip' AND url='$url'");
$data = $consult->fetch_row();
$num_rows = mysqli_num_rows($ipipip);
///////////////////

if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
    die('<font color="white" size=5">Not a valid URL.</font>');
}

$url_already = $data[4];

if($num_rows == 1){
	die('<font color="white" size=5">You already shortened this URL. <a href="/'.$url_already.'">'.$website_url.$url_already.'</a></font>');	
}

if(strlen($url) > 200){
	die('<font color="white" size=5">URL is too long.</font>');
}

if ($con->query("INSERT INTO urls (url, ip, url_shortened, visit_count) VALUES ('$url', '$ip', '$string', '0')") === TRUE) {	

mkdir($string);
$fp = fopen("$string/index.php","wb");
$content = base64_decode('PD9waHANCmluY2x1ZGUoIi4uL2NvbmZpZy5waHAiKTsgDQokc3RyaW5neiA9IHN0cl9yZXBsYWNlKCcvJywgJycsICRfU0VSVkVSWydSRVFVRVNUX1VSSSddKTsNCiR6enogPSAkY29uLT5xdWVyeSgiU0VMRUNUICogRlJPTSB1cmxzIFdIRVJFIHVybF9zaG9ydGVuZWQ9JyRzdHJpbmd6JyIpOw0KJHl5eSA9ICR6enotPmZldGNoX3JvdygpOw0KJGFkZCA9ICR5eXlbM10rMTsNCiRzcWwgPSAiVVBEQVRFIHVybHMgU0VUIHZpc2l0X2NvdW50PSckYWRkJyBXSEVSRSB1cmxfc2hvcnRlbmVkPSckc3RyaW5neiciOw0KaWYgKCRjb24tPnF1ZXJ5KCRzcWwpID09PSBUUlVFKSB7DQpoZWFkZXIoImxvY2F0aW9uOiAkeXl5WzFdIik7DQp9DQo/Pg==');
if( $fp == false ){
    die('<font color="white" size=5">Fatal error.</font>');
}else{
    fwrite($fp,$content);
    fclose($fp);
}


?>
<p id="copy" hidden><?=$website_url.$string?></p>
<?php
echo '<font color="white" size=5">Done! Here is your link: <a href="/'.$string.'">http://urlshortener.gq/'.$string.'</a>';?>  <button onclick="copyToClipboard('#copy')">Copy</button></font>
<?php
}else{
die('<font color="white" size=5">Fatal MySQL error.</font>');}
}
?>
				</div>
<?php
if(empty($_POST['submit'])){
	
if ($shorted = $con->query("SELECT * FROM urls WHERE ip='$ip' ORDER by ID DESC LIMIT 3")) {

if($shorted->num_rows){
?>
				<div class="bg-3">
				<center>
				<h1>URL's you already shortened</h1>
				</center>
				<hr>
				<?php
				    while ($fxla = $shorted->fetch_row()) {
						?>
						<p id="copy<?=$fxla[4]?>" hidden><?=$website_url.$fxla[4]?></p>
						<?php
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$fxla[1].'"><font color="#EB3B3B">'.page_title($fxla[1]).'</font></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="article-title smaller" href="'.$fxla[1].'"><font color="#EB3B3B">'.$fxla[1].'</font></a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="short-url" href="/'.$fxla[4].'"><font size="1" color="#EB3B3B">'.$website_url.$fxla[4].'</font></a>'; ?> <button onclick="copyToClipboard('#copy<?=$fxla[4]?>')">Copy</button><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="2">Visitors: <?=$fxla[3]?></font><hr>
					<?php }
					?>		
								
								</div>					
				
<?php } } } ?>

<?=base64_decode('PD9waHANCn0NCj8+DQo8c3R5bGU+DQojZm9vdGVyIHsNCiAgIHBvc2l0aW9uOmFic29sdXRlOw0KICAgYm90dG9tOjA7DQogICB3aWR0aDoxMDAlOw0KICAgaGVpZ2h0OjYwcHg7ICAgLyogSGVpZ2h0IG9mIHRoZSBmb290ZXIgKi8NCiAgIGJhY2tncm91bmQ6IzZjZjsNCn0NCiAgPC9zdHlsZT4NCiAgPGJyPg0KICA8ZGl2IGNsYXNzPSJmb290ZXIiPkNvZGVkIGJ5IEA8YSBocmVmPSJodHRwOi8vdHdpdHRlci5jb20vZGlydHlmcnZuIj48Zm9udCBjb2xvcj0iIzIwN0VDNiI+ZGlydHlmcnZuPC9mb250PjwvYT48aW1nIHNyYz0iaHR0cHM6Ly9hYnMudHdpbWcuY29tL2ljb25zL2FwcGxlLXRvdWNoLWljb24tMTkyeDE5Mi5wbmciIGhlaWdodD0iMjMiIHdpZHRoPSIyMyIgYWx0PSJUd2l0dGVyIiB0aXRsZT0iVHdpdHRlciI+DQogIDwvZGl2PgkJCTwvc2VjdGlvbj4NCiAgICA8L2JvZHk+DQo8L2h0bWw+')?>
