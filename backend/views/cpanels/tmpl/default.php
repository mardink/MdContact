<?php
/*
 * @package MDContact
 * @copyright Copyright (c)2013 Martijn Hiddink / mardinkwebdesign.com
 * @license GNU General Public License version 3 or later
 */

// Protect from unauthorized access
defined('_JEXEC') or die();

$lang = JFactory::getLanguage();
$icons_root = JURI::base().'media/com_mdcontact/images/';

$groups = array('basic','tools','update');

FOFTemplateUtils::addCSS('media://com_mdcontact/css/backend.css');
?>
<div class="row-fluid">
	<div id="mdcontact_cpanel" class="span10">
	<div class=md_cpanel_icon>
	<a href="index.php?option=com_mdcontact&view=contacts"><img src="../media/com_mdcontact/images/envelop256x256.png" />
 
</a>
</div>
<div class="md_cpanel_icon">
			<?php echo LiveUpdate::getIcon(); ?>
		</div>
</div>

	<div id="cpanel_live" class="span2">
		
		<div>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="martijn@mardink.nl">
<input type="hidden" name="lc" value="NL">
<input type="hidden" name="item_name" value="Mardink Webdesign">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
<input type="submit" class="btn btn-primary" value="Donate via PayPal" />
<!--<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
			
		</div>
	</div>
</div>

<div class="ak_clr"></div>

<div class="row-fluid footer">
<div class="span12">
	<p style="font-size: small" class="well">Copyright &copy;<?php echo date('Y');?>. <a href="http://www.mardinkwebdesign.com">Mardink Webdesign</a> All Rights Reserved.</br>
	MDContact is Free Software and is distributed under the terms of the GNU General Public License, version 3 or - at your option - any later version.</br>	
	If you use MDContact, please post a rating and a review at the Joomla! Extensions Directory. </p>
</div>
</div>

