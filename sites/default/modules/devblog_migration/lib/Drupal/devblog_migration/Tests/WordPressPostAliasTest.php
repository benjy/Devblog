<?php

/**
 * @file
 * Contains \Drupal\devblog_migration\Tests\WordPressPostAliasTest.
 */

namespace Drupal\devblog_migration\Tests;

use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\Tests\MigrateTestBase;

/**
 * Test migration of wordpress post aliases.
 */
class WordPressPostAliasTest extends MigrateTestBase {

  static $modules = array('devblog_migration', 'node');

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name'  => 'Migrate WordPress post aliases',
      'description'  => 'Migrate WordPress post aliases.',
      'group' => 'Devblog',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $id_mappings = array(
      'wp_posts' => array(
        array(array(1), array(1)),
      ),
    );
    $this->prepareIdMappings($id_mappings);

    /** @var \Drupal\migrate_drupal\Entity\Migration $migration */
    $migration = entity_load('migration', 'wp_post_alias');
    $migration->source['table_prefix'] = 'wp_';

    $dumps = array(
      drupal_get_path('module', 'devblog_migration') . '/lib/Drupal/devblog_migration/Tests/Dump/WordPressPosts.php',
    );
    $this->prepare($migration, $dumps);
    $executable = new MigrateExecutable($migration, $this);
    $executable->import();
  }

  /**
   * Tests migration of url aliases..
   */
  public function testWordPressPostAlias() {
    $conditions = array(
      'source' => 'node/1',
      'alias' => 'test-post',
      'langcode' => 'und',
    );
    $path = \Drupal::service('path.alias_storage')->load($conditions);
    $this->assertNotNull($path);
  }

}
