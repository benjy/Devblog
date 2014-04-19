<?php

/**
 * @file
 * Contains \Drupal\migrate\Plugin\migrate\source\WordPressPost.
 */

namespace Drupal\devblog_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\SourceEntityInterface;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;


/**
 * Drupal 6 node source from database.
 *
 * @MigrateSource(
 *   id = "wp_post"
 * )
 */
class WordPressPost extends SqlBase implements SourceEntityInterface {

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

  public function prepareRow(Row $row) {
    $created = $row->getSourceProperty('post_date');
    $row->setSourceProperty('post_date', strtotime($created));
    $modified = $row->getSourceProperty('post_modified');
    $row->setSourceProperty('post_modified', strtotime($modified));

    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = array(
      'ID' => $this->t('The Post ID'),
      'post_author' => $this->t('The post author.'),
      'post_date' => $this->t('The date the post was created.'),
      'post_content' => $this->t('The post content'),
      'post_title' => $this->t('The title.'),
      'post_category' => $this->t('The category Id.'),
      'post_excerpt' => $this->t('The post excerpt'),
      'post_status' => $this->t('The status of the post.'),
      'post_name' => $this->t('The machine name of the post.'),
      'post_modified' => $this->t('The last modified time.'),
      'post_type' => $this->t('The post type.'),
    );
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['ID']['type'] = 'integer';
    $ids['ID']['alias'] = 'p';
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function bundleMigrationRequired() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function entityTypeId() {
    return 'node';
  }

}
