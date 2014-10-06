<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package     MetaModels
 * @subpackage  AttributeGeoProtection
 * @author      Stefan Heimes <stefan_heimes@hotmail.com>
 * @author      David Maack <david.maack@arcor.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

$GLOBALS['METAMODELS']['attributes']['geoprotection']['class'] = 'MetaModels\Attribute\Geoprotection\GeoProtection';
$GLOBALS['METAMODELS']['attributes']['geoprotection']['image'] = 'system/modules/metamodelsattribute_geoprotection/html/geoprotection.png';

$GLOBALS['METAMODELS']['filters']['geoprotection']['class'] = 'MetaModels\Filter\Setting\Geoprotection';

$GLOBALS['TL_EVENTS'][\ContaoCommunityAlliance\Contao\EventDispatcher\Event\CreateEventDispatcherEvent::NAME][] =
	'\MetaModels\DcGeneral\Events\Table\Attribute\Geoprotection\PropertyAttribute::registerEvents';

$GLOBALS['TL_EVENTS'][\ContaoCommunityAlliance\Contao\EventDispatcher\Event\CreateEventDispatcherEvent::NAME][] =
	'\MetaModels\DcGeneral\Events\Filter\Setting\Geoprotection\Subscriber::registerEvents';

