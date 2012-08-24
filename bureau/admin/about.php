<?php
/*
$Id: adm_email.php,v 1.1 2005/09/05 10:55:48 arnodu59 Exp $
----------------------------------------------------------------------
AlternC - Web Hosting System
Copyright (C) 2005 by the AlternC Development Team.
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
Original Author of file: Benjamin Sonntag
Purpose of file: Show a form to edit a member
----------------------------------------------------------------------
*/
require_once("../class/config.php");

include("head.php");

?>
<body>
<h3><?php __("About AlternC"); ?></h3>
<i><?php __("Hosting Software");?></i>
<hr/>
<p>
<?php
__("AlternC is an automatic hosting software suite based on Debian. It features a PHP-based administration interface and scripts that manage server configuration. <br/>It can manage email, Web, Web statistics, and mailing list hosting. It is available in French, English, and Spanish.");
?>
<p>

<p>
  <ul>
    <li><?php __("Official website: ");?> <a target=_blank href="http://www.alternc.com">http://www.alternc.com</a></li>
    <li><?php __("Developper website: ");?> <a target=_blank href="http://www.alternc.org">http://www.alternc.org</a></li>
    <li><?php __("Help: ");?> <a target=_blank href="http://www.aide-alternc.com">http://www.aide-alternc.com</a></li>
  </ul>
</li>

<hr/>
<p class="center"><a href="http://www.alternc.com" target="_blank"><img src="logo2.png" border="0" alt="AlternC" /></a>
<br />
<?php 
__("You are currently using AlternC ");
echo " $L_VERSION"; 
?>

<?php include_once('foot.php');?>
