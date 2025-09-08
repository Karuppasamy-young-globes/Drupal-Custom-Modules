<?php

namespace Drupal\user_info\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'User Info'.
 *
 * @Block(
 *   id = "user_info",
 *   admin_label = @Translation("User Info"),
 * )
 */

class UserInfoBlock extends BlockBase{
    public function build(){

        /**
         * {@inheritdoc}
         */

        $current_user = \Drupal::currentUser();

        if($current_user -> isAuthenticated()){
            $userName = $current_user->getDisplayName();
            $userEmail = $current_user->getEmail();
            $userRole = implode(',', $current_user->getRoles());

            $output = "<b> User </b> $userName <br>
                       <b> Email </b> $userEmail <br> 
                       <b> Role </b> $userRole";
        }
        else{
            $output = 'Welcome Geust';
        }

        return[
            '#markup' => $output,
        ];
    }
}