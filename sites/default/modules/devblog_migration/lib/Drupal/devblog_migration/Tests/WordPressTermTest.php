<?php

/**
 * @file
 * Contains \Drupal\devblog_migration\Tests\WordPressTermTest.
 */

namespace Drupal\devblog_migration\Tests;

use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\Tests\MigrateTestBase;

/**
 * Test migration of wordpress terms.
 */
class WordPressTermTest extends MigrateTestBase {

  static $modules = array('devblog_migration', 'taxonomy');

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name'  => 'Migrate WordPress terms',
      'description'  => 'Migrate WordPress terms.',
      'group' => 'Devblog',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    /** @var \Drupal\migrate_drupal\Entity\Migration $migration */
    $migration = entity_load('migration', 'wp_terms');
    $migration->source['table_prefix'] = 'wp_';

    $dumps = array(
      drupal_get_path('module', 'devblog_migration') . '/lib/Drupal/devblog_migration/Tests/Dump/WordPressTerms.php',
    );
    $this->prepare($migration, $dumps);
    $executable = new MigrateExecutable($migration, $this);
    $executable->import();
  }

  /**
   * Test we have terms.
   */
  public function testWordPressTerms() {
    $term = entity_load('taxonomy_term', 1);
    $this->assertIdentical($term->name->value, 'General IT talk');
  }

}
