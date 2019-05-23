<?php
/**
 * @file
 * Contains \Drupal\mailbox_display\Controller\MailboxDisplay.
 */
namespace Drupal\mymodule_display\Controller;

use Drupal\Core\Controller\ControllerBase;

class MymoduleDisplay extends ControllerBase
{
    public function content()
    {
        $config = \Drupal::config('mymodule.adminsettings');
        $title = $config->get('title');
        $hobby = $config->get('hobby');

        $gender = $config->get('gender');
        return array(
        '#type' => 'markup',
        '#markup' => t('Name is @title <br> HOBBY is @hobby <br> Gender is @gender <br>', array('@title' => $title, '@hobby' => $hobby, '@gender' => $gender,)),
        );
    }
}
