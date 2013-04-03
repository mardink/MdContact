<?php
/*
 * @package MDContact
 * @copyright Copyright (c)2013 Martijn Hiddink / mardinkwebdesign.com
 * @license GNU General Public License version 2 or later
 */
 
defined('_JEXEC') or die();

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class Com_MdcontactInstallerScript
{
	/**
	 * Joomla! pre-flight event
	 *
	 * @param string $type Installation type (install, update, discover_install)
	 * @param JInstaller $parent Parent object
	 */
	public function preflight($type, $parent)
	{
		// Only allow to install on Joomla! 2.5.0 or later with PHP 5.3.0 or later
		if(defined('PHP_VERSION')) {
			$version = PHP_VERSION;
		} elseif(function_exists('phpversion')) {
			$version = phpversion();
		} else {
			$version = '5.0.0'; // all bets are off!
		}
		if(!version_compare(JVERSION, '2.5.6', 'ge')) {
			$msg = "<p>You need Joomla! 2.5.6 or later to install this component</p>";
			JError::raiseWarning(100, $msg);
			return false;
		}
		if(!version_compare($version, '5.3.1', 'ge')) {
			$msg = "<p>You need PHP 5.3.1 or later to install this component</p>";
			if(version_compare(JVERSION, '3.0', 'gt'))
			{
				JLog::add($msg, JLog::WARNING, 'jerror');
			}
			else
			{
				JError::raiseWarning(100, $msg);
			}
			return false;
		}

				return true;
	}

	/**
	 * Runs after install, update or discover_update
	 * @param string $type install, update or discover_update
	 * @param JInstaller $parent
	 */
	function postflight( $type, $parent)
	{

		// Install FOF
		$fofStatus = $this->_installFOF($parent);



		// Show the post-installation page
		$this->_renderPostInstallation($fofStatus, $parent);
	}

	

	/**
	 * Renders the post-installation message
	 */
	private function _renderPostInstallation($fofStatus, $parent)
	{
?>

<?php $rows = 1;?>
<img src="../media/com_ars/icons/ars_logo_48.png" width="48" height="48" alt="Akeeba Release System" align="right" />

<h2>Welcome to MDContact!</h2>

<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2">Extension</th>
			<th width="30%">Status</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2">MDContact component</td>
			<td><strong style="color: green">Installed</strong></td>
		</tr>
		<tr class="row1">
			<td class="key" colspan="2">
				<strong>Framework on Framework (FOF) <?php echo $fofStatus['version']?></strong> [<?php echo $fofStatus['date'] ?>]
			</td>
			<td><strong>
				<span style="color: <?php echo $fofStatus['required'] ? ($fofStatus['installed']?'green':'red') : '#660' ?>; font-weight: bold;">
					<?php echo $fofStatus['required'] ? ($fofStatus['installed'] ?'Installed':'Not Installed') : 'Already up-to-date'; ?>
				</span>
			</strong></td>
		</tr>
	</tbody>
</table>
<?php
	}

	private function _renderPostUninstallation($parent)
	{
?>
<?php $rows = 0;?>
<h2>MDContact uninstallation status</h2>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('Extension'); ?></th>
			<th width="30%"><?php echo JText::_('Status'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo 'MDContact'; ?></td>
			<td><strong style="color: green"><?php echo JText::_('Removed'); ?></strong></td>
		</tr>
			</tbody>
</table>
<?php
	}
/**
	 * Check if FoF is already installed and install if not
	 *
	 * @param   object  $parent  class calling this method
	 *
	 * @return  array            Array with performed actions summary
	 */
	private function _installFOF($parent)
	{
		$src = $parent->getParent()->getPath('source');

		// Load dependencies
		JLoader::import('joomla.filesystem.file');
		JLoader::import('joomla.utilities.date');
		$source = $src . '/fof';

		if (!defined('JPATH_LIBRARIES'))
		{
			$target = JPATH_ROOT . '/libraries/fof';
		}
		else
		{
			$target = JPATH_LIBRARIES . '/fof';
		}
		$haveToInstallFOF = false;

		if (!is_dir($target))
		{
			$haveToInstallFOF = true;
		}
		else
		{
			$fofVersion = array();

			if (file_exists($target . '/version.txt'))
			{
				$rawData = JFile::read($target . '/version.txt');
				$info    = explode("\n", $rawData);
				$fofVersion['installed'] = array(
					'version'	=> trim($info[0]),
					'date'		=> new JDate(trim($info[1]))
				);
			}
			else
			{
				$fofVersion['installed'] = array(
					'version'	=> '0.0',
					'date'		=> new JDate('2011-01-01')
				);
			}

			$rawData = JFile::read($source . '/version.txt');
			$info    = explode("\n", $rawData);
			$fofVersion['package'] = array(
				'version'	=> trim($info[0]),
				'date'		=> new JDate(trim($info[1]))
			);

			$haveToInstallFOF = $fofVersion['package']['date']->toUNIX() > $fofVersion['installed']['date']->toUNIX();
		}

		$installedFOF = false;

		if ($haveToInstallFOF)
		{
			$versionSource = 'package';
			$installer = new JInstaller;
			$installedFOF = $installer->install($source);
		}
		else
		{
			$versionSource = 'installed';
		}

		if (!isset($fofVersion))
		{
			$fofVersion = array();

			if (file_exists($target . '/version.txt'))
			{
				$rawData = JFile::read($target . '/version.txt');
				$info    = explode("\n", $rawData);
				$fofVersion['installed'] = array(
					'version'	=> trim($info[0]),
					'date'		=> new JDate(trim($info[1]))
				);
			}
			else
			{
				$fofVersion['installed'] = array(
					'version'	=> '0.0',
					'date'		=> new JDate('2011-01-01')
				);
			}

			$rawData = JFile::read($source . '/version.txt');
			$info    = explode("\n", $rawData);
			$fofVersion['package'] = array(
				'version'	=> trim($info[0]),
				'date'		=> new JDate(trim($info[1]))
			);
			$versionSource = 'installed';
		}

		if (!($fofVersion[$versionSource]['date'] instanceof JDate))
		{
			$fofVersion[$versionSource]['date'] = new JDate;
		}

		return array(
			'required'	=> $haveToInstallFOF,
			'installed'	=> $installedFOF,
			'version'	=> $fofVersion[$versionSource]['version'],
			'date'		=> $fofVersion[$versionSource]['date']->format('Y-m-d'),
		);
	}
	}
