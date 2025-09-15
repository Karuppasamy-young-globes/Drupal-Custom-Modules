<?php

namespace Drupal\commerce_reengage\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Commerce Reengage entity.
 *
 * @ContentEntityType(
 *   id = "commerce_reengage",
 *   label = @Translation("Commerce Reengage"),
 *   base_table = "rules",
 *   handlers = {
 *     "form" = {
 *       "default" = "Drupal\commerce_reengage\Form\CommerceReengageForm",
 *       "add" = "Drupal\commerce_reengage\Form\CommerceReengageForm",
 *       "edit" = "Drupal\commerce_reengage\Form\CommerceReengageForm",
 *       "delete" = "Drupal\commerce_reengage\Form\CommerceReengageDeleteForm"
 *     },
 *     "list_builder" = "Drupal\commerce_reengage\CommerceReengageListBuilder"
 *   },
 *   entity_keys = {
 *      "id" = "id",
 *      "label" = "role_name"
 *   },
 *   links = {
 *     "canonical" = "/commerce_reengage/{commerce_reengage}",
 *     "add-form" = "/commerce_reengage/add",
 *     "edit-form" = "/commerce_reengage/{commerce_reengage}/edit",
 *     "delete-form" = "/commerce_reengage/{commerce_reengage}/delete",
 *     "collection" = "/admin/content/commerce_reengage"
 *   }
 * )
 */
class CommerceReengageEntity extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t("ID"))
      ->setReadOnly(TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Enabled'))
      ->setRequired(TRUE)
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 0,
      ])
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['role_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t("Name"))
      ->setRequired(TRUE)
      ->setSettings(['max_length' => 255])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1,
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
        'label' => 'above',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['delivery_time'] = BaseFieldDefinition::create('integer')
    ->setLabel(t('Delivery time'))
    ->setDescription(t('Total delivery time in minutes'))
    ->setRequired(TRUE)
    ->setDisplayOptions('form', [
        'type' => 'delivery_time_widget', 
        'weight' => 1,
    ])
    ->setDisplayOptions('view', [
        'type' => 'number_integer',
        'weight' => 2,
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);


    $fields['priority'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Priority'))
      ->setDisplayOptions('form', [
        'type' => "number",
        'weight' => 4,
      ])
      ->setDisplayOptions('view', [
        'type' => "number_integer",
        'weight' => 4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['discount_rule'] = BaseFieldDefinition::create('entity_reference')
    ->setLabel(t("Discount Rule"))
    ->setSetting('target_type', 'commerce_promotion')
    ->setDisplayOptions('form', [
        'type' => 'options_select',
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('integer')
        ->setLabel(t("Created At"))
        ->setReadOnly(TRUE)
        ->setDefaultValue(REQUEST_TIME);

    $fields['changed'] = BaseFieldDefinition::create('integer')
        ->setLabel(t("Modified At"))
        ->setReadOnly(TRUE)
        ->setDefaultValue(REQUEST_TIME);

    return $fields;
  }
}
