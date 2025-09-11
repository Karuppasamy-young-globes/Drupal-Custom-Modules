<?php

namespace Drupal\commerce_reengage\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * 
 * @ContentTypeEntity(
 *   id = 'commerce_reengage',
 *   label = @Translation('Commerce Reengage'),
 *   base_table = 'rules',
 *   handlers = {
 *     'form' = {
 *       'add' = 'Drupal\commerce_reengage', 
 *     }
 *   }
 * )
 */