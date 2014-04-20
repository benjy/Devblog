<?php

/**
 * @file
 * Contains \Drupal\migrate\Plugin\migrate\source\WordPressTermBase.
 */

namespace Drupal\devblog_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Get the WordPress terms.
 */
abstract class WordPressTermBase extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select($this->configuration['table_prefix'] . 'terms', 't')
      ->fields('t', array_keys($this->fields()));

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['term_id']['type'] = 'integer';
    $ids['term_id']['alias'] = 't';
    return $ids;
  }

}
