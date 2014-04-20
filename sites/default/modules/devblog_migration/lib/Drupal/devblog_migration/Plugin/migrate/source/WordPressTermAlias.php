<?php

/**
 * @file
 * Contains \Drupal\migrate\Plugin\migrate\source\WordPressTermAlias.
 */

namespace Drupal\devblog_migration\Plugin\migrate\source;

/**
 * Get the WordPress term aliases.
 *
 * @MigrateSource(
 *   id = "wp_term_alias"
 * )
 */
class WordPressTermAlias extends WordPressTermBase {

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = array(
      'term_id' => $this->t('The term Id'),
      'slug' => $this->t('The term url alias.'),
    );
    return $fields;
  }

}
