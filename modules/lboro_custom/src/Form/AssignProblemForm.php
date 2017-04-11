<?php

namespace Drupal\lboro_custom\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Drupal\views\Views;

/**
 * Contribute form.
 */
class AssignProblemForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'lboro_assign_problem_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $problem_id=1) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => t('Title!'),
      '#required' => true
    ];

    $node = \Drupal\node\Entity\Node::load($problem_id);
    if (is_null($node)) {
      throw new NotFoundHttpException();
    }

    $view = Views::getView('problems');
    $view->get_total_rows = TRUE;
    $view->execute();
    $total_rows = count($view->result);

    $form['view count'] = [
      '#type' => 'textfield',
      '#title' => t('Title!'),
      '#value' => $total_rows,
      '#required' => true
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Save')
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
  }

}
