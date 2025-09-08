<?php

namespace Drupal\contact_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

/**
 * It provide a contact Form
 */

class ContactForm extends FormBase{
    /**
     * {@inheritdoc}
     */

    public function getFormId(){
        return 'contact_form';
    }

    /**
     * {@inheritdoc}
     */

    public function buildForm( array $form, FormStateInterface $form_state ){
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Your Name'),
            '#required' => TRUE,
        ];
        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Your Email'),
            '#required' => TRUE,
        ];
        $form['mobile_number'] = [
            '#type' => 'number',
            '#title' => $this->t('Mobile Number'),
            '#required' => TRUE,
        ];
        $form['message'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Message'),
            '#required' => TRUE,
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state){
        $conn = Database::getConnection();
        $conn->insert('contact_form')->fields([
            'name' => $form_state->getValue('name'),
            'email' => $form_state->getValue('email'),
            'mobile_number' => $form_state->getValue('mobile_number'),
            'message' => $form_state->getValue('message'),
            'created' => \Drupal::time()->getCurrentTime(),
        ])->execute();

    $this->messenger()->addMessage($this->t('Thanks for submitting the contact form.'));
    }

}
