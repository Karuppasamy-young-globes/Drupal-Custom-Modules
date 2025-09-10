<?php

namespace Drupal\course\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access control handler for the Course entity.
 */
class CourseAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view course');

      case 'update':
        if ($account->hasPermission('edit course')) {
          return AccessResult::allowed();
        }
        if ($account->hasPermission('edit own course') && $account->id() == $entity->get('owner_id')->target_id) {
          return AccessResult::allowed();
        }
        return AccessResult::forbidden();

      case 'delete':
        if ($account->hasPermission('delete course')) {
          return AccessResult::allowed();
        }
        if ($account->hasPermission('delete own course') && $account->id() == $entity->get('owner_id')->target_id) {
          return AccessResult::allowed();
        }
        return AccessResult::forbidden();
    }
    return AccessResult::forbidden();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add course');
  }
}
