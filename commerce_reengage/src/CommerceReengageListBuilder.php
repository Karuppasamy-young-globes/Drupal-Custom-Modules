<?php

namespace Drupal\commerce_reengage;

use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

class CommerceReengageListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['role_name'] = $this->t('Name');
    $header['status'] = $this->t('Status');
    $header['delivery_time'] = $this->t('Delivery Time');
    $header['discount_rule'] = $this->t('Discount Rule');
    $header['created'] = $this->t('Created At');
    $header['changed'] = $this->t('Modified At');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['role_name'] = $entity->get('role_name')->value;
    $row['status'] = $entity->get('status')->value ? "Enabled" : "Disabled";

    $min = $entity->get("delivery_time")->value;

    if($min >= 10080){
        $weeks = floor($min/10080);
        $row['delivery_time'] =  $weeks . " week" . ($weeks > 1 ? 's' : '');
    }
    elseif($min >= 1440){
        $days = floor($min/1400);
        $row["delivery_time"] = $days . " day" . ($days > 1 ? 's' : '');
    }
    elseif($min >= 60){
        $hrs = floor($min/60);
        $row['delivery_time'] = $hrs . " hour" . ($hrs > 1 ? 's' : '');
    }
    else{
        $minutes = floor($minutes/60);
        $row['delivery_time'] = $minutes . " minute" . ($minutes > 1 ? 's' : ''); 
    }

    $row['discount_rule'] = $entity->get("discount_rule")->value;

    $created_timestrap = $entity->get("created") -> value;
    $changed_timestrap = $entity->get("changed") -> value;
    $row['created'] = date("M j, Y g:i A", $created_timestrap);
    $row['changed'] = date("M j, Y g:i A", $changed_timestrap);


    return $row + parent::buildRow($entity);
  }


}
