<?php

namespace Drupal\sorteos\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'combinacion_quintuple' field type.
 *
 * @FieldType (
 *   id = "combinacion_quintuple",
 *   label = @Translation("Combinacion Quintuple"),
 *   description = @Translation(""),
 *   default_widget = "combinacion_quintuple",
 *   default_formatter = "combinacion_quintuple"
 * )
 */
class CombinacionQuintupleItem extends FieldItemBase
{
    /**
     * How the data will be stored in database
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition)
    {
        return array(
            'columns' => array(
                'bola1' => array(
                    'type' => 'int',
                    'not null' => FALSE,
                    //'length' => 5
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
                'bola6' => array(
                    'type' => 'int',
                    'not null' => FALSE,
                    'length' => 5
                )
            ),
        );
        //The definitions in columns work the same way as the Drupal 8 schema API which you can use for reference if you need to.
    }

    /**
     * Esta Vacio si ninguno de los valores contiene nada
     */
    public function isEmpty()
    {
        $value1 = $this->get('bola1')->getValue();
        $value2 = $this->get('bola2')->getValue();
        $value3 = $this->get('bola3')->getValue();
        $value4 = $this->get('bola4')->getValue();
        $value5 = $this->get('bola5')->getValue();
        $value6 = $this->get('bola6')->getValue();

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
        $properties['bola6'] = DataDefinition::create('integer')
            ->setLabel('Bola 6')
            ->setSetting('unsigned', TRUE);

        return $properties;
    }
}
