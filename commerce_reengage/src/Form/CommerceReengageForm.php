<?php

namespace Drupal\Commerce_reengage\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class CommerceReengageForm extends ContentEntityForm{
    public function buildForm(array $form, FormStateInterface $form_state){
        $form = parent::buildForm($form, $form_state);
        return $form;
    }

    public function save(array $form, FormStateInterface $form_state ){
        $entity = $this->getEntity();
        $status = parent::save($form, $form_state);

        if ($status == SAVED_NEW) {
        $this->messenger()->addMessage(
            $this->t('Created %label rules', ['%label' => $entity->label()])
        );
        }
        else {
        $this->messenger()->addMessage(
            $this->t('Updated %label rules', ['%label' => $entity->label()])
        );
        }

        $account = \Drupal::currentUser();

        if($account->id() == 1){
            $form_state->setRedirect('<front>');
        }
        else{
            $form_state->setRedirect('<front>');
        }
    }
}