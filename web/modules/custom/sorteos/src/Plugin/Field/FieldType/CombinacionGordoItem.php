<?php

namespace Drupal\sorteos\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'combinacion_gordo' field type.
 *
 * @FieldType (
 *   id = "combinacion_gordo",
 *   label = @Translation("Combinacion Gordo"),
 *   description = @Translation(""),
 *   default_widget = "combinacion_gordo",
 *   default_formatter = "combinacion_gordo"
 * )
 */
class CombinacionGordoItem extends FieldItemBase
{
    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition)
    {
        return array(
            'columns' => array(
                'bola1' => array(
                    'type' => 'int',
                    'not null' => FALSE,
                ),
                'bola2' => array(
                    'type' => 'int',
                    'not null' => FALSE,
                ),
                'bola3' => array(
                    'type' => 'int',
                    'not null' => FALSE,
                ),
                'bola4' => array(
                    'type' => 'int',
                    'not null' => FALSE,
                ),
                'bola5' => array(
                    'type' => 'int',
                    'not null' => FALSE,
                ),
                'clave' => array(
                    'type' => 'int',
                    'not null' => FALSE,
                )
            ),
        );
        //The definitions in columns work the same way as the Drupal 8 schema API which you can use for reference if you need to.
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        $value1 = $this->get('bola1')->getValue();
        $value2 = $this->get('bola2')->getValue();
        $value3 = $this->get('bola3')->getValue();
        $value4 = $this->get('bola4')->getValue();
        $value5 = $this->get('bola5')->getValue();
        $value6 = $this->get('clave')->getValue();
        return empty($value1) && empty($value2) && empty($value3) && empty($value4) && empty($value5) && empty($value6);
    }

    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition)
    {
        $properties['bola1'] = DataDefinition::create('integer')
            ->setLabel('Bola 1')
            ->setSetting('unsigned', TRUE);
        $properties['bola2'] = DataDefinition::create('integer')
            ->setLabel('Bola 2')
            ->setSetting('unsigned', TRUE);
        $properties['bola3'] = DataDefinition::create('integer')
            ->setLabel('Bola 3')
            ->setSetting('unsigned', TRUE);
        $properties['bola4'] = DataDefinition::create('integer')
            ->setLabel('Bola 4')
            ->setSetting('unsigned', TRUE);
        $properties['bola5'] = DataDefinition::create('integer')
            ->setLabel('Bola 5')
            ->setSetting('unsigned', TRUE);
        $properties['clave'] = DataDefinition::create('integer')
            ->setLabel('Clave')
            ->setSetting('unsigned', TRUE);

        return $properties;
    }
}
