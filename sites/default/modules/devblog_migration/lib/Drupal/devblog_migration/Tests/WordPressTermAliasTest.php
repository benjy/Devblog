<?php

/**
 * @file
 * Contains \Drupal\devblog_migration\Tests\WordPressTermAliasTest.
 */

namespace Drupal\devblog_migration\Tests;

use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\Tests\MigrateTestBase;

/**
 * Test migration of wordpress term aliases.
 */
class WordPressTermAliasTest extends MigrateTestBase {

  static $modules = array('devblog_migration', 'taxonomy');

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name'  => 'Migrate WordPress term aliases',
      'description'  => 'Migrate WordPress term aliases.',
      'group' => 'Devblog',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $id_mappings = array(
      'wp_terms' => array(
        array(array(1), array(1)),
      ),
    );
    $this->prepareIdMappings($id_mappings);

    /** @var \Drupal\migrate_drupal\Entity\Migration $migration */
    $migration = entity_load('migration', 'wp_term_alias');
    $migration->source['table_prefix'] = 'wp_';

    $dumps = array(
      drupal_get_path('module', 'devblog_migration') . '/lib/Drupal/devblog_migration/Tests/Dump/WordPressTerms.php',
    );
    $this->prepare($migration, $dumps);
    $executable = new MigrateExecutable($migration, $this);
    $executable->import();
  }

  /**
   * Tests migration of url aliases.
   */
  public function testWordPressTermAlias() {
    $conditions = array(
      'source' => 'taxonomy/term/1',
      'alias' => 'general-it-talk',
      'langcode' => 'und',
    );
    $path = \Drupal::service('path.alias_storage')->load($conditions);
    $this->assertNotNull($path);
  }

}
