<?php

namespace Drupal\vefl\Plugin\views\exposed_form;

use Drupal\views\Plugin\views\exposed_form\Basic;
use Drupal\Core\Form\FormStateInterface;
use Drupal\vefl\Vefl;

/**
 * Exposed form plugin that provides a basic exposed form with layout.
 *
 * @ingroup views_exposed_form_plugins
 *
 * @ViewsExposedForm(
 *   id = "vefl_basic",
 *   title = @Translation("Basic (with layout)"),
 *   help = @Translation("Adds layout settings for Exposed form")
 * )
 */
class VeflBasic extends Basic {

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['layout2'] = array(
      'contains' => array(
        'layout_id' => array('default' => 'vefl_onecol'),
        'regions' => array('default' => array()),
        'widget_region' => array('default' => array()),
      ),
    );
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    //
    $layout_id = $this->options['layout2']['layout_id'];
    $layouts = Vefl::getLayouts();

    // Outputs layout selectbox.
    $form['layout2'] = array(
      '#type' => 'details',
      '#title' => $this->t('Layout settings'),
    );
    $form['layout2']['layout_id'] = array(
      '#prefix' => '<div class="container-inline">',
      '#type' => 'select',
      '#options' => Vefl::getLayoutOptions($layouts),
      '#title' => t('Layout'),
      '#default_value' => $layout_id,
    );
    $form['layout2']['change'] = array(
      '#type' => 'submit',
      '#value' => t('Change'),
      '#submit' => array(array($this, 'updateRegions')),
      '#suffix' => '</div>',
    );
    $form['layout2']['widget_region'] = VeflBasic::getRegionElements($layout_id, $layouts);
  }
//
//   /**
//    * @param $layout_id
//    * @param array $layouts
//    * @return array
//    */
  private function getRegionElements($layout_id, $layouts = array()) {

    $element = array(
      '#prefix' => '<div id="edit-block-region-wrapper">',
      '#suffix' => '</div>',
    );
    // Outputs regions selectbox for each filter.
    $types = array(
      'filters' => $this->view->display_handler->getHandlers('filter'),
      'actions' => Vefl::getFormActions(),
    );

    // Adds additional action for BEF combined sort. @todo
//    if (!empty($vars['widgets']['sort-sort_bef_combine'])) {
//      $actions[] = 'sort-sort_bef_combine';
//    }


    $regions = array();
    foreach ($layouts[$layout_id]->getRegions() as $region_id => $region) {
      $regions[$region_id] = $region['label'];
    }
    foreach ($types as $type => $fields) {
      foreach ($fields as $id => $filter) {
        if ($type == 'filters') {
          if (!$filter->options['exposed']) {
            continue;
          }
          $filter = $filter->definition['title'];
        }

        $element[$id] = array(
          '#type' => 'select',
          '#title' => $filter,
          '#options' => $regions,
        );

        // Set default region for chosen layout.
        if (!empty($this->options['layout2']['widget_region'][$id]) && !empty($regions[$this->options['layout2']['widget_region'][$id]])) {
          $element[$id]['#default_value'] = $this->options['layout2']['widget_region'][$id];
        }
      }
    }
    return $element;
  }

  /**
   * Form submission handler for ContentTranslationHandler::entityFormAlter().
   *
   * Takes care of content translation deletion.
   */
  function updateRegions($form, FormStateInterface $form_state) {
    $view = $form_state->get('view');
    $display_id = $form_state->get('display_id');

    $display = &$view->getExecutable()->displayHandlers->get($display_id);
    // optionsOverride toggles the override of this section.
    $display->optionsOverride($form, $form_state);
    $display->submitOptionsForm($form, $form_state);

    $view->cacheSet();
    $form_state->set('rerender', TRUE);
    $form_state->setRebuild();
  }

//   /**
//    * @inheritdoc
//    */
  public function exposedFormAlter(&$form, FormStateInterface $form_state) {
    parent::exposedFormAlter($form, $form_state);

    $view = $form_state->get('view');
    $layout_id = $this->options['layout2']['layout_id'];
    $widget_region = $this->options['layout2']['widget_region'];

    $form['#vefl_configuration'] = [
      'layout2' => [
        'id' => $layout_id,
        'settings' => [],
      ],
      'regions' => []
    ];

    foreach ($widget_region as $field_name => $region) {
      $form['#vefl_configuration']['regions'][$region][] = $field_name;

      // Provides default wrapper settings for Display suite layout.
      if (substr($layout_id, 0, 3) == 'ds_') {
        $form['#vefl_configuration']['layout2']['settings']['wrappers'][$region] = 'div';
      }
    }

    $form['#theme'] = $view->buildThemeFunctions('vefl_views_exposed_form');
  }

}
