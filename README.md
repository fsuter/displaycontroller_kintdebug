Display Controller - Debug with Kint
====================================

This TYPO3 CMS extension provides an alternate formatting for the debug output
of extension [displaycontroller](http://typo3.org/extensions/repository/view/displaycontroller)
(from the [Tesseract package](http://www.typo3-tesseract.com/en/)) using
the [Kint library](http://raveren.github.io/kint/) by Rokas Šleinius.

To use this output, open displaycontroller's extension configuration
and set the **Debug output class** to `Tx_DisplaycontrollerKintdebug_Service_Debug`.

![Display Controller configuration screen](/Documentation/Images/DebugOutputSetup.png)


Installation
------------

Just activate the extension and configure as explained above.


Historical note
---------------

Using this extension produces the same debug output that was available
in extension displaycontroller from version 1.2.0 to version 1.4.1.

The debugging was revamped in version 1.5.0 and this "old" way of debugging
was packaged into a separate extension for those who might prefer it to
the "new" one.
