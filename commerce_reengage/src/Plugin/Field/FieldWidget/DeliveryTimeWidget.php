<?php

namespace Drupal\commerce_reengage\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'delivery_time_widget' widget.
 *
 * @FieldWidget(
 *   id = "delivery_time_widget",
 *   label = @Translation("Delivery time (days, hours, minutes)"),
 *   field_types = {
 *     "integer"
 *   }
 * )
 */
class DeliveryTimeWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = $items[$delta]->value ?? 0;

    // Convert minutes into days, hours, minutes.
    $days = floor($value / 1440);
    $hours = floor(($value % 1440) / 60);
    $minutes = $value % 60;

    $element['days'] = [
      '#type' => 'number',
      '#title' => $this->t('Days'),
      '#default_value' => $days,
      '#min' => 0,
    ];
    $element['hours'] = [
      '#type' => 'number',
      '#title' => $this->t('Hours'),
      '#default_value' => $hours,
      '#min' => 0,
      '#max' => 23,
    ];
    $element['minutes'] = [
      '#type' => 'number',
      '#title' => $this->t('Minutes'),
      '#default_value' => $minutes,
      '#min' => 0,
      '#max' => 59,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    foreach ($values as &$value) {
      $days = (int) ($value['days'] ?? 0);
      $hours = (int) ($value['hours'] ?? 0);
      $minutes = (int) ($value['minutes'] ?? 0);
      // Convert to total minutes for storage.
      $value['value'] = $days * 1440 + $hours * 60 + $minutes;
    }
    return $values;
  }

}
