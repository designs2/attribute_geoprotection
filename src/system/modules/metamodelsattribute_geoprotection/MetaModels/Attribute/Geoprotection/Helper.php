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

namespace MetaModels\Attribute\Geoprotection;

/**
 * This is the MetaModelAttribute class for handling text fields.
 *
 * @package       MetaModels
 * @subpackage    AttributeGeoProtection
 * @author        Christian Schiffler <c.schiffler@cyberspectrum.de>
 */
class Helper
{
	/**
	 * Get a list with all countries.
	 *
	 * @param array $arrValues a list with preset values.
	 *
	 * @return array|null The new list.
	 */
	public static function getCountriesByContinent($arrValues = array())
	{
		// Init all vars.
		$return    = array();
		$countries = array();
		$arrAux    = array();
		$arrTmp    = array();

		// Load the language files.
		\System::loadLanguageFile('countries');
		\System::loadLanguageFile('continents');

		// Include all files with name.
		include(TL_ROOT . '/system/config/countries.php');
		include(TL_ROOT . '/system/config/countriesByContinent.php');

		/** @var $countriesByContinent array */
		foreach ($countriesByContinent as $strConKey => $arrCountries)
		{
			$strConKeyTranslated = strlen($GLOBALS['TL_LANG']['CONTINENT'][$strConKey]) ? utf8_romanize($GLOBALS['TL_LANG']['CONTINENT'][$strConKey]) : $strConKey;
			$arrAux[$strConKey]  = $strConKeyTranslated;
			foreach ($arrCountries as $key => $strCounntry)
			{
				if (!is_array($arrValues) || in_array($key, $arrValues))
				{
					$arrTmp[$strConKeyTranslated][$key] = strlen($GLOBALS['TL_LANG']['CNT'][$key]) ? utf8_romanize($GLOBALS['TL_LANG']['CNT'][$key]) : $countries[$key];
				}
			}
		}

		ksort($arrTmp);

		foreach ($arrTmp as $strConKey => $arrCountries)
		{
			asort($arrCountries);
			//get original continent key
			$strOrgKey           = array_search($strConKey, $arrAux);
			$strConKeyTranslated = strlen($GLOBALS['TL_LANG']['CONTINENT'][$strOrgKey]) ? ($GLOBALS['TL_LANG']['CONTINENT'][$strOrgKey]) : $strConKey;
			foreach ($arrCountries as $strKey => $strCountry)
			{
				$return[$strConKeyTranslated][$strKey] = strlen($GLOBALS['TL_LANG']['CNT'][$strKey]) ? $GLOBALS['TL_LANG']['CNT'][$strKey] : $countries[$strKey];
			}
		}

		$return[$GLOBALS['TL_LANG']['CONTINENT']['other']]['xx'] = strlen($GLOBALS['TL_LANG']['CNT']['xx']) ? $GLOBALS['TL_LANG']['CNT']['xx'] : 'No Country';

		// Add to the event.
		return $return;
	}
}