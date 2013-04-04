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
	<div id="mdcontact_cpanel" class="span8">
	<div class=md_cpanel_icon>
	<a href="index.php?option=com_mdcontact&view=contacts"><img src="../media/com_mdcontact/images/envelop256x256.png" />
 
</a>
</div>
</div>

	<div id="cpanel_live" class="span4">
	<?php echo LiveUpdate::getIcon(); ?>
	</div>
</div>

<div class="ak_clr"></div>

<div class="row-fluid footer">
<div class="span12">
	<p style="font-size: small" class="well">Copyright &copy;<?php echo date('Y');?>. <a href="http://www.mardinkwebdesign.com">Mardink Webdesign</a> All Rights Reserved.</p>
</div>
</div>
