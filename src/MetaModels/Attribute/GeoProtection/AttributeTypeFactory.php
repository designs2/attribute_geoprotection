<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package     MetaModels
 * @subpackage  AttributeLinkedSelect
 * @author      Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author      Stefan Heimes <stefan_heimes@hotmail.com>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

namespace MetaModels\Attribute\GeoProtection;

use MetaModels\Attribute\AbstractAttributeTypeFactory;
use MetaModels\Attribute\Events\CreateAttributeFactoryEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class AttributeTypeFactory
 *
 * @package MetaModels\Attribute\GeoProtection
 */
class AttributeTypeFactory extends AbstractAttributeTypeFactory implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            CreateAttributeFactoryEvent::NAME => 'registerLegacyAttributeFactoryEvents',
        );
    }

    /**
     * Register all legacy factories and all types defined via the legacy array as a factory.
     *
     * @param CreateAttributeFactoryEvent $event The event.
     *
     * @return void
     */
    public static function registerLegacyAttributeFactoryEvents(CreateAttributeFactoryEvent $event)
    {
        $factory = $event->getFactory();
        $factory->addTypeFactory(new static());
    }

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->typeName  = 'geoprotection';
        $this->typeClass = 'MetaModels\Attribute\GeoProtection\GeoProtection';
    }
}
