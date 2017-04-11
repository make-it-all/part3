<?php

namespace Drupal\vefl;

use Drupal\layout_plugin\Layout;

/**
 * Helper class that holds all the main Display Suite helper functions.
 */
class Vefl {

  /**
   * Gets Display Suite layouts.
   */
  public static function getLayouts() {
    static $layouts = FALSE;

    if (!$layouts) {
      $layouts = Layout::layoutPluginManager()->getDefinitions();
    }

    return $layouts;
  }

  /**
   * Gets Display Suite layouts.
   */
  public static function getLayoutOptions($layouts = array()) {
    if (empty($layouts)) {
      $layouts = Vefl::getLayouts();
    }

    // Converts layouts array to options.
    $layout_options = array();
    foreach ($layouts as $key => $layout_definition) {
      $optgroup = t('Other');

      // Create new layout option group.
      $category = $layout_definition->getCategory();
      if (!empty($category)) {
        $optgroup = (string) $category;
      }

      if (!isset($layout_options[$optgroup])) {
        $layout_options[$optgroup] = array();
      }

      // Stack the layout.
      $layout_options[$optgroup][$key] = $layout_definition->getLabel();
    }

    // If there is only one $optgroup, move it to the root.
    if (count($layout_options) < 2) {
      $layout_options = reset($layout_options);
    }
    \Drupal::logger('my_module')->notice(print_r($layout_options, true));

    return $layout_options;
  }

  /**
   * Returns action fields for views exposed form.
   */
  public static function getFormActions() {
    $actions = array(
      'sort_by' => t('Sort by'),
      'sort_order' => t('Sort order'),
      'items_per_page' => t('Items per page'),
      'offset' => t('Offset'),
      'submit' => t('Submit button'),
      'reset' => t('Reset button'),
    );
    return $actions;
  }
}
