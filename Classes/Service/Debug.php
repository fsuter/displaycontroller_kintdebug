<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2013 Francois Suter (Cobweb) <typo3@cobweb.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * Alternate debugging output for the 'displaycontroller' extension
 * using Kint (http://raveren.github.io/kint/)
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_displaycontrollerkintdebug
 *
 * $Id: class.tx_displaycontroller_debugger.php 57074 2012-01-31 21:46:36Z francois $
 */
class Tx_DisplaycontrollerKintdebug_Service_Debug extends tx_displaycontroller_debugger {

	public function __construct(t3lib_PageRenderer $pageRenderer) {
		$this->pageRenderer = $pageRenderer;
			// Prepare CSS code based on t3skin, if loaded
		if (t3lib_extMgm::isLoaded('t3skin')) {
			$this->cssCode = t3lib_div::getUrl(t3lib_extMgm::extPath('t3skin') . 'stylesheets/structure/element_message.css');
			$this->cssCode .= t3lib_div::getUrl(t3lib_extMgm::extPath('t3skin') . 'stylesheets/visual/element_message.css');
				// Adjust path to icons
			$replacement = t3lib_div::locationHeaderUrl(TYPO3_mainDir . t3lib_extMgm::extRelPath('t3skin') . 'icons');
			$this->cssCode = str_replace('../../icons', $replacement, $this->cssCode);
		}
			// Load the Kint class for dumping debug data
		require_once(t3lib_extMgm::extPath('displaycontroller_kintdebug', 'Classes/Kint/Kint.class.php'));
	}

	/**
	 * Renders all messages and dumps their related data
	 *
	 * @param array $messageQueue List of messages to display
	 * @return string Debug output
	 */
	public function render(array $messageQueue) {
		$debugOutput = '';
			// If this is the first debug call, write the necessary CSS code
		if ($this->firstCall) {
			$debugOutput .= '<style>' . $this->cssCode . '</style>';
			$this->firstCall = FALSE;
		}
			// Prepare the output and return it
		foreach ($messageQueue as $messageData) {
			$debugOutput .= $messageData['message']->render();
			if ($messageData['data'] !== NULL) {
				if (is_array($messageData['data'])) {
					$debugData = $messageData['data'];
				} else {
					$debugData = array($messageData['data']);
				}
				$debugOutput .= @Kint::dump($debugData);
			}
		}

		return $debugOutput;
	}
}
?>