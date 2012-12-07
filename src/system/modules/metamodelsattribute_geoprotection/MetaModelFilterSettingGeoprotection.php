<?php

class MetaModelFilterSettingGeoprotection extends MetaModelFilterSetting {

	/**
	 * 
	 * @param IMetaModelFilter $objFilter
	 * @param type $arrFilterUrl
	 * @return type
	 */
	public function prepareRules(IMetaModelFilter $objFilter, $arrFilterUrl) 
	{
		$objAttribute = $this->getMetaModel()->getAttributeById($this->get('gp_attr_id'));
		if ($objAttribute) {
			$objGeo = Geolocation::getInstance();
			$arrCountry = $objGeo->getUserGeolocation()->getCountriesShort();
			//set 'no_country' if no country was found
			$arrCountry = ($arrCountry) ? $arrCountry : array('xx');
			
            //build query string part
			foreach ($arrCountry as $k => $val)
			{
				$arrCountry[$k] = "find_in_set ('$arrCountry[$k]', countries)";
			}
            
			$arrMyFilterUrl = array_slice($arrFilterUrl, 0);
			$objFilterRule = new MetaModelFilterRuleSimpleQuery(
					'SELECT item_id FROM tl_metamodel_geoprotection WHERE attr_id = ? AND 
						((mode = \'\') OR (mode = \'gp_show\' AND ('.implode(' OR ',$arrCountry).')) OR  (mode = \'gp_hide\' AND NOT ('.implode(' OR ',$arrCountry).')))',
					array($this->get('gp_attr_id')),
					'item_id'
			);

			$objFilter->addFilterRule($objFilterRule);
					return;

		}
		//  no attribute found 
		$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList(array()));
	}

}

?>