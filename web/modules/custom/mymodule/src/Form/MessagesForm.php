<?php
/**
 * @file
 * Contains Drupal\mymodule\Form\MessagesForm.
 */
namespace Drupal\mymodule\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MessagesForm extends ConfigFormBase
{

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return [
        'mymodule.adminsettings',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'mymodule_form';
    }

     /**
      * {@inheritdoc}
      */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('mymodule.adminsettings');

        $form['title'] = array(
          '#type' => 'textfield',
          '#title' => t('Name'),
          '#required' => true,
          '#default_value' => $config->get('title'),
        );
        $form['hobby'] = array(
          '#type' => 'select',
          '#description' => 'Select the desired hobby.',
         '#options' => array(t('--- SELECT ---'), t('Badminton'), t('Reading novels'), t('Dancing')),
          '#title' => t('Hobby'),
          '#default_value' => $config->get('hobby'),
        );
        $options = array(
          'male' => t('Male'),
          'female' => t('Female'),
        );
        $form['gender'] = array(
          '#type' => 'radios',
          '#title' => t('Gender'),
          '#options' => $options,
          '#default_value' => $config->get('gender'),
        );
          return parent::buildForm($form, $form_state);
    }
    /**
    * {@inheritdoc}
    */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        parent::submitForm($form, $form_state);

        $this->config('mymodule.adminsettings')
            ->set('title', $form_state->getValue('title'))
            ->set('hobby', $form_state->getValue('hobby'))
            ->set('gender', $form_state->getValue('gender'))
            ->save();

        foreach ($form_state->getValues() as $key => $value) {
            drupal_set_message($key . ': ' . $value);
        }
    }
}
