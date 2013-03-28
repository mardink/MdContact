<?php
/*
 * @package MDContact
 * @copyright Copyright (c)2013 Martijn Hiddink / mardinkwebdesign.com
 * @license GNU General Public License version 2 or later
 */

defined('_JEXEC') or die();

require_once JPATH_COMPONENT_ADMINISTRATOR.'/liveupdate/liveupdate.php';
if(JRequest::getCmd('view','') == 'liveupdate') {
	LiveUpdate::handleRequest();
	return;
}

// Load FOF
include_once JPATH_LIBRARIES.'/fof/include.php';
if(!defined('FOF_INCLUDED')) {
	JError::raiseError ('500', 'FOF is not installed');
}

FOFDispatcher::getTmpInstance('com_mdcontact')->dispatch();