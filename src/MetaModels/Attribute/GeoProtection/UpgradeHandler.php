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
 * @subpackage Core
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     David Maack <david.mack@arcor.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\Attribute\GeoProtection;

/**
 * Upgrade handler class that changes structural changes in the database.
 * This should rarely be necessary but sometimes we need it.
 */
class UpgradeHandler
{
    /**
     * Retrieve the database instance from Contao.
     *
     * @return \Database
     *
     * @SuppressWarnings(PHPMD.ShortMethodName)
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected static function DB()
    {
        return \Database::getInstance();
    }


    /**
     * Handle database upgrade for the gp_attr_id 0> attr_id field in tl_metamodel_filtersetting.
     *
     * Since the field gr_attr_id will be removed, the information should be stored in the field attr_id.
     * Only update attr_id if this field is empty
     *
     * @return void
     */
    protected static function upgradeFiterSettingAttrId()
    {
        $objDB = self::DB();
        if ($objDB->tableExists('tl_metamodel_filtersetting', null, true)
            && $objDB->fieldExists('gp_attr_id', 'tl_metamodel_filtersetting', true)
        ) {
            // update the field
            $objDB->execute('UPDATE `tl_metamodel_filtersetting` set attr_id = gp_attr_id WHERE TYPE = "geoprotection" AND attr_id = 0');
        }
    }

    /**
     * Perform all upgrade steps.
     *
     * @return void
     */
    public static function update()
    {
        self::upgradeFiterSettingAttrId();
    }
}
