<?php

namespace Drupal\course;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityViewBuilder;

/**
 * Provides a View Builder for the Course entity.
 */
class CourseViewBuilder extends EntityViewBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildContent(array $build, EntityInterface $entity, $view_mode, $langcode) {
    $build = parent::buildContent($build, $entity, $view_mode, $langcode);

    $build['course_code'] = [
      '#type' => 'markup',
      '#markup' => '<p><strong>Code:</strong> ' . $entity->get('course_code')->value . '</p>',
    ];

    $build['course_name'] = [
      '#type' => 'markup',
      '#markup' => 'Name: ' . $entity->get('course_name')->value . '</p>',
    ];

    $build['description'] = [
      '#type' => 'markup',
      '#markup' => '<p><strong>Description:</strong> ' . $entity->get('description')->value . '</p>',
    ];

    $build['course_duration'] = [
      '#type' => 'markup',
      '#markup' => '<p><strong>Duration (hours):</strong> ' . $entity->get('course_duration')->value . '</p>',
    ];

    $build['course_is_active'] = [
      '#type' => 'markup',
      '#markup' => '<p><strong>Status:</strong> ' . ($entity->get('course_is_active')->value ? 'Active' : 'Inactive') . '</p>',
    ];

    return $build;
  }

}
