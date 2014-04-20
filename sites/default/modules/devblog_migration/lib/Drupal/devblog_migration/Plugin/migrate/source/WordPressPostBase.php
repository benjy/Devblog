<?php

/**
 * @file
 * Contains \Drupal\migrate\Plugin\migrate\source\WordPressPostBase.
 */

namespace Drupal\devblog_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;


/**
 * Base class for querying for wordpress posts.
 */
abstract class WordPressPostBase extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Get all the posts, post_type=post filters out revisions and pages.
    $query = $this->select($this->configuration['table_prefix'] . 'posts', 'p')
      ->fields('p', array_keys($this->fields()))
      ->condition('post_type', 'post');

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['ID']['type'] = 'integer';
    $ids['ID']['alias'] = 'p';
    return $ids;
  }

}
