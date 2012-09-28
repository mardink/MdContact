<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
class MdContactController extends JController
{
	function mailer()
	{
		$from = array($_POST["email"], $_POST["yourname"]);
# set emailadres from the site		
		$config =& JFactory::getConfig();
		$to = array(
				$config->getValue( 'config.mailfrom' ),
				$config->getValue( 'config.fromname' ) );
# Set some variables for the email message
$subject = "Vraag via de website";
		$copy = $_POST["copy"];
		$body = $_POST["message"];
 
# Invoke JMail Class
$mailer = JFactory::getMailer();
 
# Set sender array so that my name will show up neatly in your inbox
$mailer->setSender($from);
$mailer->addRecipient($to);
# Set cc if copy is checked
if ($copy=="copy"){
$mailer->addCC($from);}
$mailer->setSubject($subject);
$mailer->setBody($body);
$mailer->isHTML();
$send =& $mailer->Send();
if ( $send !== true ) {
	JFactory::getApplication()->enqueueMessage('Your message is not send, please try again later');
} else {
	JFactory::getApplication()->enqueueMessage('Your message is succesfully send');
}

# Set the view
#$link = JRoute::_('index.php?option=com_mdcontact&view=mdcontact&id=1', false);
#$msg = 'Message is succesfully send';
#$this->setRedirect($link, $msg);
	}
}