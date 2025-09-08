<?php

namespace Drupal\time\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Time' Block.
 *
 * @Block(
 *   id = "time_block",
 *   admin_label = @Translation("Time Block")
 * )
 */

class TimeBlock extends BlockBase{

    /**
     * {@inheritdoc}
     */

    public function build() {
        $time = date('H:i:s');
        return [
        '#markup' => $this->t('Current time is @time', ['@time' => $time]),
        ];
    }
}