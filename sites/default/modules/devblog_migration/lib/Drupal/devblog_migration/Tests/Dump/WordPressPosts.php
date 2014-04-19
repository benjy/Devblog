<?php

/**
 * @file
 * Contains \Drupal\devblog_migration\Tests\Dump\WordPressPosts.
 */

namespace Drupal\devblog_migration\Tests\Dump;

use Drupal\Core\Database\Connection;

/**
 * Database dump for testing wordpress post migration.
 */
class WordPressPosts {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Sample database schema and values.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public function load() {

    $this->database->schema()->createTable('wp_posts', array(
      'description' => 'Stores WordPress posts.',
      'fields' => array(
        'ID' => array(
          'type' => 'int',
          'not null' => TRUE
        ),
        'post_author' => array(
          'type' => 'int',
          'not null' => TRUE,
          'default' => 0,
        ),
        'post_date' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE
        ),
        'post_content' => array(
          'type' => 'text',
          'not null' => TRUE,
          'size' => 'medium'
        ),
        'post_title' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
        ),
        'post_category' => array(
          'type' => 'int',
          'unsigned' => TRUE,
          'not null' => TRUE,
          'size' => 'tiny'
        ),
        'post_excerpt' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => ''
        ),
        'post_status' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
        ),
        'post_name' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => ''
        ),
        'post_modified' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => '',
        ),
        'post_type' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => '',
        ),
      ),
      'primary key' => array('ID'),
    ));

    $this->database->insert('wp_posts')->fields(array(
      'ID',
      'post_author',
      'post_date',
      'post_content',
      'post_title',
      'post_category',
      'post_excerpt',
      'post_status',
      'post_name',
      'post_modified',
      'post_type',
    ))
    ->values(array(
      'ID' => 1,
      'post_author' => 1,
      'post_date' => '2009-03-24 05:15:34',
      'post_content' => 'This is an example of a WordPress page, you could',
      'post_title' => 'Test Post',
      'post_category' => 0,
      'post_excerpt' => '',
      'post_status' => 'inherit',
      'post_name' => 'test-post',
      'post_modified' => '2009-03-24 05:15:34',
      'post_type' => 'post',
    ))
    ->values(array(
      'ID' => 2,
      'post_author' => 1,
      'post_date' => '2009-03-24 05:15:34',
      'post_content' => 'This is an example of a WordPress page, you could',
      'post_title' => 'Test Post',
      'post_category' => 0,
      'post_excerpt' => '',
      'post_status' => 'publish',
      'post_name' => 'test-post',
      'post_modified' => '2009-03-24 05:15:34',
      'post_type' => 'post',
    ))
    ->values(array(
      'ID' => 3,
      'post_author' => 1,
      'post_date' => '2009-03-24 05:15:34',
      'post_content' => 'This is an example of a WordPress page, you could',
      'post_title' => 'Test Post',
      'post_category' => 0,
      'post_excerpt' => '',
      'post_status' => 'inherit',
      'post_name' => 'test-post',
      'post_modified' => '2009-03-24 05:15:34',
      'post_type' => 'revision',
    ))
    ->execute();
  }

}
