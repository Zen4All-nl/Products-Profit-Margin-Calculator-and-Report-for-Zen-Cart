<?php

/**
 * Profit Margin Calculator module
 * @version 3.0.0
 * @author Zen4All
 * @copyright (c) 2014-2020, Zen4All
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 */
$autoLoadConfig[0][] = [
  'autoType' => 'class',
  'loadFile' => 'observers/admin.zcObserverProfitMargin.php',
  'classPath' => DIR_WS_CLASSES
];
$autoLoadConfig[200][] = [
  'autoType' => 'classInstantiate',
  'className' => 'profitMarginAdminObserver',
  'objectName' => 'profitMargin'
];
