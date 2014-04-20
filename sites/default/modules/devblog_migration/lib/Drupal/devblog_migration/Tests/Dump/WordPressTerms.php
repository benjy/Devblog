<?php

/**
 * @file
 * Contains \Drupal\devblog_migration\Tests\Dump\WordPressTerms.
 */

namespace Drupal\devblog_migration\Tests\Dump;

use Drupal\Core\Database\Connection;

/**
 * Database dump for testing wordpress terms migration.
 */
class WordPressTerms {

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

    $this->database->schema()->createTable('wp_terms', array(
      'description' => 'Stores WordPress posts.',
      'fields' => array(
        'term_id' => array(
          'type' => 'int',
          'not null' => TRUE
        ),
        'name' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
        ),
        'slug' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => ''
        ),
        'term_group' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'default' => 0,
        ),
      ),
      'primary key' => array('term_id'),
    ));

    $this->database->insert('wp_terms')->fields(array(
      'term_id',
      'name',
      'slug',
    ))
    ->values(array(
      'term_id' => 1,
      'name' => 'General IT talk',
      'slug' => 'general-it-talk',
    ))
    ->values(array(
      'term_id' => 2,
      'name' => 'Drupal',
      'slug' => 'drupal',
    ))
    ->execute();
  }

}
