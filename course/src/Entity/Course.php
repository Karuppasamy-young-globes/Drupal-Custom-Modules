<?php

namespace Drupal\course\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 *
 * @ContentEntityType(
 *   id = "course",
 *   label = @Translation("Course"),
 *   base_table = "course",
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\course\Form\CourseForm",
 *       "edit" = "Drupal\course\Form\CourseForm",
 *       "delete" = "Drupal\course\Form\CourseDeleteForm"
 *     },
 *     "list_builder" = "Drupal\course\CourseListBuilder",
 *     "view_builder" = "Drupal\course\CourseViewBuilder",
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "course_name"
 *   },
 *   links = {
 *     "canonical" = "/course/{course}",
 *     "add-form" = "/course/add",
 *     "edit-form" = "/course/{course}/edit",
 *     "delete-form" = "/course/{course}/delete",
 *     "collection" = "/admin/content/courses"
 *   }
 * )
 */

class Course extends ContentEntityBase {

  /**
   * Defines base fields for Course entity.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = [];

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setReadOnly(TRUE);

    $fields['course_code'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Course Code'))
      ->setRequired(TRUE)
      ->setSettings(['max_length' => 10])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['course_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Course Name'))
      ->setRequired(TRUE)
      ->setSettings(['max_length' => 255])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Course Description'))
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'text_default',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['course_duration'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Course Duration (hours)'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'number',
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'number_integer',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['course_is_active'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Course Active'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'boolean',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
