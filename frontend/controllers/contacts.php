<?php
/*
 * @package MDContact
 * @copyright Copyright (c)2013 Martijn Hiddink / mardinkwebdesign.com
 * @license GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

class MdcontactControllerContacts extends FOFController
{
	/**
	 * This runs before the browse() method. Return false to prevent executing
	 * the method.
	 * 
	 * @return bool
	 */
	public function onBeforeBrowse() {
		$result = parent::onBeforeBrowse();
		if($result) {
			// Get the current order by column
			$orderby = $this->getThisModel()->getState('filter_order','');
			// If it's not one of the allowed columns, force it to be the "ordering" column
			if(!in_array($orderby, array('mdcontact_contact_id','ordering','title','due'))) {
				$orderby = 'ordering';
			}
			// Apply ordering and filter only the enabled items
			$this->getThisModel()
				->filter_order($orderby)
				->enabled(1);
		}
		return $result;
	}
	/**
	 * Overwrite on beforeAdd. So guest users see the view.
	 * Edit permissions must be granted for guest to send the email
	 */
	
	function onBeforeAdd() {
		return true;
	}
	
	/**
	 * Overwrite on beforeApply. So guest users see the view.
	 * Edit permissions must be granted for guest to send the email
	 */
	
	function onBeforeApply() {
		return true;
	}
	/**
	 * Overwrite on beforeApply. So guest users see the view.
	 * Edit permissions must be granted for guest to send the email
	 */
	
	function onBeforeEdit() {
		return true;
	}
	/**
	 * Send email. After succesfull send the info will be to de apply function of FoF and stored in the database
	 *
	 *
	 *
	 */
	
	function mailer() {
		JRequest::checkToken() or die( JText::_( 'Invalid Token' ) );
		$email = JRequest::getVar('email');
		$title = JRequest::getVar('title');
		$from = array($email, $title);
		// set emailadres from the site
		$config =&JFactory::getConfig();
		// Get some variables from the component options
		$app = JFactory::getApplication('site');
		$componentParams = $app->getParams('com_mdcontact');
		$email_to = $componentParams->get('email_to');
		$subject = $componentParams->get('subject');
		$to = array($email_to, $email_to );
		// Set some variables for the email message
		$copy = JRequest::getVar('copy');;
		$body = JRequest::getVar('description');;
	
		// Invoke JMail Class
		$mailer = JFactory::getMailer();
	
		// Set sender array so that my name will show up neatly in your inbox
		$mailer->setSender($from);
		$mailer->addRecipient($to);
		// Set cc if copy is checked
		if ($copy=='1'){
			$mailer->addCC($from);
			}
		$mailer->setSubject($subject);
		$mailer->setBody($body);
		$send = $mailer->Send();
		// set the redirect page
		$redirect = JRoute::_('index.php?option=com_mdcontact&view=contact&task=add');
		if ( $send !== true ) {
			JFactory::getApplication()->enqueueMessage('Your message is not send, please try again later', 'error');
			$this->setRedirect( $redirect);
		} else {
		parent::apply();
	}
	}		
}