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

namespace MetaModels\DcGeneral\Events\Filter\Setting\Geoprotection;

use ContaoCommunityAlliance\Contao\EventDispatcher\Event\CreateEventDispatcherEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\DecodePropertyValueForWidgetEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\EncodePropertyValueFromWidgetEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent;
use ContaoCommunityAlliance\DcGeneral\Factory\Event\BuildDataDefinitionEvent;
use MetaModels\Attribute\Geoprotection\Helper;
use MetaModels\DcGeneral\Events\BaseSubscriber;

/**
 * Handle events for tl_metamodel_attribute.alias_fields.attr_id.
 */
class Subscriber
	extends BaseSubscriber
{
	/**
	 * Register all listeners to handle creation of a data container.
	 *
	 * @param CreateEventDispatcherEvent $event The event.
	 *
	 * @return void
	 */
	public static function registerEvents(CreateEventDispatcherEvent $event)
	{
		$dispatcher = $event->getEventDispatcher();
		self::registerBuildDataDefinitionFor(
			'tl_metamodel_filtersetting',
			$dispatcher,
			__CLASS__ . '::registerTableMetaModelAttributeEvents'
		);
	}

	/**
	 * Register the events for table tl_metamodel_attribute.
	 *
	 * @param BuildDataDefinitionEvent $event The event being processed.
	 *
	 * @return void
	 */
	public static function registerTableMetaModelAttributeEvents(BuildDataDefinitionEvent $event)
	{
		static $registered;
		if ($registered)
		{
			return;
		}
		$registered = true;
		$dispatcher = $event->getDispatcher();

		self::registerListeners(
			array(
				GetPropertyOptionsEvent::NAME
				=> 'MetaModels\DcGeneral\Events\Table\FilterSetting\PropertyAttributeId::getOptions',
				DecodePropertyValueForWidgetEvent::NAME
				=> 'MetaModels\DcGeneral\Events\Table\FilterSetting\PropertyAttributeId::decodeValue',
				EncodePropertyValueFromWidgetEvent::NAME
				=> 'MetaModels\DcGeneral\Events\Table\FilterSetting\PropertyAttributeId::encodeValue'
			),
			$dispatcher,
			array('tl_metamodel_filtersetting', 'gp_attr_id')
		);
	}

}
