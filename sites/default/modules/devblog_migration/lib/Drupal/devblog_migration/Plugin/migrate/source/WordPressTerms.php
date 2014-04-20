<?php

/**
 * @file
 * Contains \Drupal\migrate\Plugin\migrate\source\WordPressTerms.
 */

namespace Drupal\devblog_migration\Plugin\migrate\source;

/**
 * Get the WordPress terms.
 *
 * @MigrateSource(
 *   id = "wp_terms"
 * )
 */
class WordPressTerms extends WordPressTermBase {

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = array(
      'term_id' => $this->t('The term Id'),
      'name' => $this->t('The term name.'),
    );
    return $fields;
  }

}
