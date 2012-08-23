<?php
/*
 $Id: main.php,v 1.3 2004/05/19 14:23:06 benjamin Exp $
 ----------------------------------------------------------------------
 AlternC - Web Hosting System
 Copyright (C) 2002 by the AlternC Development Team.
 http://alternc.org/
 ----------------------------------------------------------------------
 Based on:
 Valentin Lacambre's web hosting softwares: http://altern.org/
 ----------------------------------------------------------------------
 LICENSE

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License (GPL)
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 To read the license please visit http://www.gnu.org/copyleft/gpl.html
 ----------------------------------------------------------------------
 Original Author of file:
 Purpose of file:
 ----------------------------------------------------------------------
*/
require_once("../class/config.php");

include_once("head.php");

include_once("menu.php");

// Show last login information :
echo "<p>";
__("Last Login: ");

echo format_date('the %3$d-%2$d-%1$d at %4$d:%5$d',$mem->user["lastlogin"]);
printf("&nbsp;"._('from: <code> %1$s </code>')."<br />",$mem->user["lastip"]);
echo "</p>";

if ($mem->user["lastfail"]) {
	printf(_("%1\$d login failed since last login")."<br />",$mem->user["lastfail"]);
}

?>
<center>
<?php
$feed_url = variable_get('rss_feed');
if (!empty($feed_url)) {
$cache_time = 60*5; // 5 minutes
$cache_file = "/tmp/alterncpanel_cache_main.rss";
$timedif = @(time() - filemtime($cache_file));

if (file_exists($cache_file) && $timedif < $cache_time) {
  $string = file_get_contents($cache_file);
} else {
  $string = file_get_contents("$feed_url");
  file_put_contents($cache_file,$string);
}
$xml = @simplexml_load_string($string);

// place the code below somewhere in your html
echo '<table cellspacing="0" cellpadding="6" border="1" style="border-collapse: collapse">';
echo '<tr><th>'._("Title").'</th><th>'._("Date").'</th></tr>';
$count = 0;
$max = 5;
foreach ($xml->channel->item as $val) {
if ($count < $max) {
  echo '
  <tr>
    <td><a href="'.$val->link.'">'.$val->title.'</a></td><td>'.strftime("%d/%m/%Y" , strtotime($val->pubDate)).'</td></td>
  </tr>';
}
$count++;
}
echo "</table>\n</center>";

} // empty feed_url

if($admin->enabled) {
  $expiring = $admin->renew_get_expiring_accounts();

  if(count($expiring) > 0) {
    echo "<h2>" . _("Expired or about to expire accounts") . "</h2>\n";
    echo "<table cellspacing=\"2\" cellpadding=\"4\">\n";
    echo "<tr><th>"._("uid")."</th><th>"._("Last name, surname")."</th><th>"._("Expiry")."</th></tr>\n";
  if (is_array($expiring)) {
	    foreach($expiring as $account) {
      echo "<tr class=\"exp{$account['status']}\"><td>{$account['uid']}</td>";
      if($admin->checkcreator($account['uid']))
	echo "<td><a href=\"adm_edit.php?uid={$account['uid']}\">{$account['nom']}, {$account['prenom']}</a></td>";
      else
	echo "<td>{$account['nom']}, {$account['prenom']}</td>";
      echo "<td>{$account['expiry']}</td></tr>\n";
    }
}
    echo "</table>\n";
  }
}

$c=@mysql_fetch_array(mysql_query("SELECT * FROM membres WHERE uid='".$cuid."';"));

define("QUOTASONE","1");
require_once("quotas_oneuser.php");


?>
<?php include_once("foot.php"); ?>
