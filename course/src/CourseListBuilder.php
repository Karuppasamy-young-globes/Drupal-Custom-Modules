<?php

namespace Drupal\course;

use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

class CourseListBuilder extends EntityListBuilder{

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['course_code'] = $this->t('Code');
    $header['course_name'] = $this->t('Course Name');
    $header['description'] = $this->t('Description');
    $header['course_duration'] = $this->t('Duration (Week)');
    $header['course_is_active'] = $this->t('Is Active');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['course_code'] = $entity->get('course_code')->value;
    $row['course_name'] = $entity->get('course_name')->value;
    $row['description'] = $entity->get('description')->value;
    $row['course_duration'] = $entity->get('course_duration')->value;
    $row['course_is_active'] = $entity->get('course_is_active')->value ? 'Active' : 'Inactive';
    return $row + parent::buildRow($entity);
  }

}
