<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHTML::_('behavior.formvalidation');
?>
<div class="container-fluid component_blok">
<div class="row-fluid">
<div class="span5 offset1">
<address>
  <strong>Mardink Webdesign</strong><br>
  Valkenhof 89<br>
  7051 XC Varsseveld, The Netherlands<br>
  Chamber of commerce: 09179087<br>
  <a href="mailto:support@mardinkwebdesign.com">support@mardinkwebdesign.com</a>
</address>
</div>
<div class="span4">
<p>Fill in the form and we will contact you as soon as possible</p>
<form id="mdcontactform" class="form form-validate" action="index.php?option=com_mdcontact&task=mailer" method="post" >
  <input type="text" name="yourname" id="yourname" placeholder="Your name…">
  <div class="control-group">
    <label class="control-label" for="inputEmail"></label>
    <div class="controls">
      <input type="text" name="email" id="inputEmail" class="required validate-email"placeholder="Emailadress..">
    </div>
  </div>
  <textarea type="text" rows="5" name="message" id="message" class="required" placeholder="Type your message…"></textarea>
  <div class="control-group">
    <div class="controls">
      <label class="checkbox">
        <input type="checkbox" name="copy" value="copy"> Send a copy of this message to yourself</label>
        <?php echo JHTML::_( 'form.token' ); ?>
      <button type="submit" class="btn">Send</button>
    </div>
  </div>
</form>
</div>
</div>
</div>