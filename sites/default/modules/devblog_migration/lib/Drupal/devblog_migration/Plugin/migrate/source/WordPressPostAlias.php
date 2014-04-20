<?php

/**
 * @file
 * Contains \Drupal\migrate\Plugin\migrate\source\WordPressPostAlias.
 */

namespace Drupal\devblog_migration\Plugin\migrate\source;

/**
 * Get the post aliases.
 *
 * @MigrateSource(
 *   id = "wp_post_alias"
 * )
 */
class WordPressPostAlias extends WordPressPostBase {

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = array(
      'ID' => $this->t('The Post ID'),
      'post_name' => $this->t('The machine name of the post.'),
    );
    return $fields;
  }

}
