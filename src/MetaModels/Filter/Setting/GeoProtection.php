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
 * @author      David Greminger <david.greminger@1up.io>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

namespace MetaModels\Filter\Setting;

use Geolocation;
use MetaModels\Filter\IFilter;
use MetaModels\Filter\Rules\SimpleQuery;
use MetaModels\Filter\Rules\StaticIdList;

/**
 * Class GeoProtection.
 *
 * @package MetaModels\Filter\Setting
 */
class GeoProtection extends Simple
{
    /**
     * {@inheritdoc}
     */
    public function prepareRules(IFilter $objFilter, $arrFilterUrl)
    {
        $objAttribute = $this->getMetaModel()->getAttributeById($this->get('gp_attr_id'));
        if ($objAttribute) {
            $objGeo     = Geolocation::getInstance();
            $arrCountry = $objGeo->getUserGeolocation()->getCountriesShort();
            // Set 'no_country' if no country was found.
            $arrCountry = ($arrCountry) ? $arrCountry : array('xx');

            // Build query string part.
            foreach (array_keys($arrCountry) as $k) {
                $arrCountry[$k] = "find_in_set ('" . $arrCountry[$k] . "', countries)";
            }

            $objFilterRule = new SimpleQuery(
                'SELECT item_id FROM tl_metamodel_geoprotection WHERE attr_id = ? AND
                    ((mode = \'\') OR (mode = \'gp_show\' AND ('.implode(' OR ', $arrCountry).')) OR
                    (mode = \'gp_hide\' AND NOT ('.implode(' OR ', $arrCountry).')))',
                array($this->get('gp_attr_id')),
                'item_id'
            );

            $objFilter->addFilterRule($objFilterRule);

            return;
        }
        // No attribute found.
        $objFilter->addFilterRule(new StaticIdList(array()));
    }
}
