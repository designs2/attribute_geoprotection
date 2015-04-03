<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package    MetaModels
 * @subpackage FilterTags
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     David Maack <david.maack@arcor.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\Filter\Setting;

/**
 * Attribute type factory for tags filter settings.
 */
class GeoProtectionFilterSettingTypeFactory extends AbstractFilterSettingTypeFactory
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->setTypeName('geoprotection')
            ->setTypeIcon('system/modules/geoprotection/html/filter_tags.png')
            ->setTypeClass('MetaModels\Filter\Setting\GeoProtection')
            ->allowAttributeTypes();

        foreach (array(
                     'geoprotection'
                 ) as $attribute) {
            $this->addKnownAttributeType($attribute);
        }
    }
}
