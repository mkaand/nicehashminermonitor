<?php
/*
NiceHash RSS Feeder v1.01
Credits: Kaan Doğan Twitter: @mkaand
Date: 07.10.2017

This PHP scripts uses NiceHashMiner public API.
It supports NiceHashMiner's all supported algoritmas.
Basically, It pulls your miner's current situation and
it generates RSS Feed. You can use this RSS feed for sending yourself a notification
or email. I use ifttt.com and Telegram service for getting notification.
Both are free. I hope you will like this script.

***********DONATION REQUEST PLEASE READ BEFORE YOU USE THIS SCRIPT**********
Before you start using this script, please respect my work. 
I share this script as FREE OF CHARGE,
But if you want to show your appreciation please make DONATION..

DONATION BTC: 1LaZG8XELxs9JCzzVJaWyhxQG6tCcswJnx

THANKS
****************************************************************************
Requirements :
PHP Hosting (Write permission for this file)
Brain

Usage:
Just change Settings and upload this script to your hosting.
This script generates RSS feed for your NiceHash Miner. 
You can integrate with ifttt.com (free service). 
In my case ifttt.com checks this RSS feed, if miner is working,
it sends me Telegram messages like:

Miner is online
Currently, NiceHashMiner is online and working with 
Sia [0.06 GH/s | 0.00000003 BTC] Blake2s [8.02 GH/s | 0.00008200 BTC]

(Default ifttt.com checks RSS feeds every 15 minutes)

If miner goes offline RSS entry changes:

Miner is offline
Currently, NiceHashMiner is offline

*/
$online_offline="Miner is online"; //DO NOT CHANGE

ini_set('display_errors', 1);
	
$algos = array( 
array(1, "Scrypt", ""), //
array(1, "SHA256", ""), //
array(1, "ScryptNf", ""), //
array(1, "X11", ""), //
array(1, "X13", ""), //
array(1000, "Keccak", "MH/s"),
array(1, "X15", ""), //
array(1000, "Nist5", "MH/s"),
array(1000, "NeoScrypt", "MH/s"),
array(1, "Lyra2RE", "MH/s"), //
array(1, "WhirlpoolX", ""), //
array(1, "Qubit", ""), //
array(1, "Quark", ""), //
array(1, "Axiom", ""), //
array(1000, "Lyra2REv2", "MH/s"),
array(1, "ScryptJaneNf16", ""), //
array(1, "Blake256r8", ""), //
array(1, "Blake256r14", ""), //
array(1, "Blake256r8vnl", ""), //
array(1, "Hodl", ""), //
array(1, "DaggerHashimoto", ""), //
array(1, "Decred", "GH/s"),
array(1000000, "CryptoNight", "KH/s"),
array(1, "Lbry", "GH/s"),
array(1000000000, "Equihash", "Sol/s"),
array(1, "Pascal", "GH/s"),
array(1000, "X11Gost", "MH/s"),
array(1, "Sia", "GH/s"),
array(1, "Blake2s", "GH/s"),
array(1000, "Skunk", "MH/s")
);

$myfile = "nicehash_rss.php";
$file_content = file_get_contents($myfile);

$publishtime = date(DATE_RSS);
header('Content-type: application/xml');
$apiurl="https://api.nicehash.com/api?method=stats.provider&addr=";

//Settings
$baseurl="http://kaan.dogan.org"; //PHP Script should run under this URL.
$bitcoin_addr="1LaZG8XELxs9JCzzVJaWyhxQG6tCcswJnx"; //Change this line with your BTC address. Please make donation for me :o) Thanks.

$data = @file_get_contents($apiurl.$bitcoin_addr);
$data = json_decode($data, true);
$status = "Miner is offline";

for ($i = 0; $i < count($data['result']['stats']); $i++) {
	 
$total_speed = $total_speed + $data['result']['stats'][$i]['accepted_speed'];
if ($data['result']['stats'][$i]['accepted_speed'] > 0) {
	$multiply = $algos[$data['result']['stats'][$i]['algo']][0];
	$current_unit = $algos[$data['result']['stats'][$i]['algo']][2];
	$current_speed = number_format($data['result']['stats'][$i]['accepted_speed']*$multiply, 2, '.', '');
	$current_balance = $data['result']['stats'][$i]['balance'];
	$current_algo = $algos[$data['result']['stats'][$i]['algo']][1];
	$current_state = $current_state . " " . $current_algo . " [" . $current_speed . " " . $current_unit . " | " . $current_balance . " BTC]";
	}//if end

}//for end

if ($total_speed > 0) {
$status = "Miner is online";
$description = "Currently, NiceHash" . $status . " and working with" . $current_state;
}else{
$description = "Currently, NiceHash" . $status;
}

function str_replace_first($from, $to, $subject)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $subject, 1);
}


If ($status == $online_offline){
$guid = date("Y-m-d-H");	
}else{
$guid = date("Y-m-d-H") . mt_rand();	
If ($online_offline=="Miner is offline"){file_put_contents($myfile, str_replace_first('$online_offline="Miner is offline"; //DO NOT CHANGE','$online_offline="Miner is online"; //DO NOT CHANGE', $file_content));}
If ($online_offline=="Miner is online"){file_put_contents($myfile, str_replace_first('$online_offline="Miner is online"; //DO NOT CHANGE','$online_offline="Miner is offline"; //DO NOT CHANGE', $file_content));}
}

?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>NiceHash Miner RSS Feed</title>
<description>Miner status monitor for NiceHash Pool System</description>
<link><?=$baseurl?>/nicehash_rss.php</link>
<copyright>Kaan Dogan</copyright>
<atom:link href="<?=$baseurl?>/nicehash_rss.php" rel="self" type="application/rss+xml" />
<item>
        <title><?=$status?></title>
        <description><?=$description?></description>
        <link><?=$baseurl?>/nicehash_rss.php?<?=$guid;?></link>
        <pubDate><?=$publishtime?></pubDate>
		<guid isPermaLink="false"><?=$guid;?></guid>
     </item>
</channel>
</rss>
