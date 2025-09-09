<?php

namespace Drupal\course\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Course entity add/edit forms.
 */
class CourseForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $status = parent::save($form, $form_state);

    if ($status == SAVED_NEW) {
      $this->messenger()->addMessage($this->t('Created the %label course.', [
        '%label' => $entity->label(),
      ]));
    }
    else {
      $this->messenger()->addMessage($this->t('Updated the %label course.', [
        '%label' => $entity->label(),
      ]));
    }

    $form_state->setRedirect('entity.course.collection');
  }

}
