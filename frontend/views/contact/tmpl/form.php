<?php
/*
 * @package MDContact
 * @copyright Copyright (c)2013 Martijn Hiddink / mardinkwebdesign.com
 * @license GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

// Load the CSS file
FOFTemplateUtils::addCSS('media://com_mdcontact/css/frontend.css');

// Load the Javascript framework for Joomla!
JHTML::_('behavior.framework');

// Joomla! editor object
$editor = JFactory::getEditor();
?>
<form action="index.php" method="post" id="adminForm">
	<input type="hidden" name="option" value="com_mdcontact" />
	<input type="hidden" name="view" value="contact" />
	<input type="hidden" name="task" value="mailer" />
	<input type="hidden" name="mdcontact_contact_id" value="" />
	<input type="hidden" name="<?php echo JFactory::getSession()->getFormToken();?>" value="1" />
<div class="mdcontact">
<h1 class="title"> Contact Form</h1>
<div class="content" >
<?php
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
?>
<div class="container-fluid component_blok">
<div class="row-fluid">
<div class="span5 offset1">
<address>
<?php 
$app = JFactory::getApplication('site');
$componentParams = $app->getParams('com_mdcontact');
$adress = $componentParams->get('adress');
$intro = $componentParams->get('intro');
echo $adress;
?>
</address>
</div>
<div class="span4">
<p><?php echo $intro;?></p>
  <input type="text" name="title" id="yourname" placeholder="Your name..">
  <div class="control-group">
    <label class="control-label" for="inputEmail"></label>
    <div class="controls">
      <input type="text" name="email" id="inputEmail" class="required validate-email"placeholder="Emailadress..">
    </div>
  </div>
  <textarea type="textarea" rows="5" name="description" id="message" class="required" placeholder="Type your message.."></textarea>
  <div class="control-group">
    <div class="controls">
      <label class="checkbox">
        <input type="checkbox" name="copy" value="1"><?php echo JText::_( 'COM_MDCONTACT_LBL_CONTACT_COPY' );?></label>
       <button type="submit" class="btn"><?php echo JText::_( 'COM_MDCONTACT_LBL_CONTACT_SUBMIT' );?></button>
    </div>
  </div>

</div>
</div>
</div>
</div>
</div>
</form>