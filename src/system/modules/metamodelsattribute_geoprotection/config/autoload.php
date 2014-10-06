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
 * @author      Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author      Andreas Isaak <info@andreas-isaak.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// MetaModels
	'MetaModels\Attribute\Geoprotection\Helper'                                   => 'system/modules/metamodelsattribute_geoprotection/MetaModels/Attribute/Geoprotection/Helper.php',
	'MetaModels\Attribute\Geoprotection\GeoProtection'                            => 'system/modules/metamodelsattribute_geoprotection/MetaModels/Attribute/Geoprotection/GeoProtection.php',
	'MetaModels\DcGeneral\Events\Table\Attribute\Geoprotection\PropertyAttribute' => 'system/modules/metamodelsattribute_geoprotection/MetaModels/DcGeneral/Events/Table/Attribute/Geoprotection/PropertyAttribute.php',
	'MetaModels\DcGeneral\Events\Filter\Setting\Geoprotection\Subscriber'         => 'system/modules/metamodelsattribute_geoprotection/MetaModels/DcGeneral/Events/Filter/Setting/Geoprotection/Subscriber.php',
	'MetaModels\Filter\Setting\Geoprotection'                                     => 'system/modules/metamodelsattribute_geoprotection/MetaModels/Filter/Setting/Geoprotection.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mm_attr_geoprotection' => 'system/modules/metamodelsattribute_geoprotection/templates',
));
