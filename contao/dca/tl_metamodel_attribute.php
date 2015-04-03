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
 * @author      Stefan Heimes <stefan_heimes@hotmail.com>
 * @author      David Maack <david.maack@arcor.de>
 * @author      Andreas Isaak <info@andreas-isaak.de>
 * @author      David Greminger <david.greminger@1up.io>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

/**
 * Table tl_metamodel_attribute
 */

$GLOBALS['TL_DCA']['tl_metamodel_attribute']['metapalettes']['geoprotection extends _simpleattribute_'] = array(
    '+display' => array('geoprotection after description'),
);

$GLOBALS['TL_DCA']['tl_metamodel_attribute']['fields']['geoprotection'] = array(
    'label'                 => &$GLOBALS['TL_LANG']['tl_metamodel_attribute']['geoprotection'],
    'exclude'               => true,
    'inputType'             => 'checkbox',
    'eval'                  => array(
        'doNotSaveEmpty' => true,
        'alwaysSave'     => true,
        'multiple'       => true,
    ),
);
