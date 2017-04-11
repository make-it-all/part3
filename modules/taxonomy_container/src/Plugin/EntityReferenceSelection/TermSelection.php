<?php

namespace Drupal\taxonomy_container\Plugin\EntityReferenceSelection;

use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\taxonomy\Plugin\EntityReferenceSelection\TermSelection as baseTermSelection;

/**
 * Provides specific access control for the taxonomy_term entity type.
 *
 * @EntityReferenceSelection(
 *   id = "taxonomy_container",
 *   label = @Translation("Taxonomy term selection (with groups)"),
 *   entity_types = {"taxonomy_term"},
 *   group = "taxonomy_container",
 *   weight = 1
 * )
 */
class TermSelection extends baseTermSelection {

  /**
   * {@inheritdoc}
   */
  public function getReferenceableEntities($match = NULL, $match_operator = 'CONTAINS', $limit = 0) {

    if ($match || $limit) {
      return parent::getReferenceableEntities($match, $match_operator, $limit);
    }

    $options = [];

    $bundles = $this->entityManager->getBundleInfo('taxonomy_term');
    $handler_settings = $this->configuration['handler_settings'];
    $bundle_names = !empty($handler_settings['target_bundles']) ? $handler_settings['target_bundles'] : array_keys($bundles);

    foreach ($bundle_names as $bundle) {
      if ($vocabulary = Vocabulary::load($bundle)) {
        $terms = $this->entityManager
          ->getStorage('taxonomy_term')
          ->loadTree($vocabulary->id(), 0, NULL, TRUE);
        if ($terms) {
          foreach ($terms as $term) {
            if ($term->parents[0] == 0) {
              $parent_name = $term->label();
            }
            else {
              $options[$vocabulary->id()][$parent_name][$term->id()] = str_repeat('-', $term->depth) . $term->label();
            }
          }
        }
      }
    }

    return $options;
  }

}
