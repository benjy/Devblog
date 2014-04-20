<?php

/**
 * @file
 * Contains \Drupal\devblog_migration\Tests\WordPressPostTest.
 */

namespace Drupal\devblog_migration\Tests;

use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\Tests\MigrateTestBase;

/**
 * Tests migration of wordpress posts.
 */
class WordPressPostTest extends MigrateTestBase {

  static $modules = array('devblog_migration', 'node');

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name'  => 'Migrate WordPress posts',
      'description'  => 'Migrate WordPress posts.',
      'group' => 'Devblog',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
    entity_create('node_type', array('type' => 'article'))->save();
    /** @var \Drupal\migrate_drupal\Entity\Migration $migration */
    $migration = entity_load('migration', 'wp_posts');
    $migration->source['table_prefix'] = 'wp_';
    $dumps = array(
      drupal_get_path('module', 'devblog_migration') . '/lib/Drupal/devblog_migration/Tests/Dump/WordPressPosts.php',
    );
    $this->prepare($migration, $dumps);
    $executable = new MigrateExecutable($migration, $this);
    $executable->import();
  }

  /**
   * Tests migration of WordPress posts.
   */
  public function testWordPressPosts() {
    $node = node_load(1);
    $this->assertEqual($node->id(), 1);
    $this->assertEqual($node->body->value, 'This is an example of a WordPress page, you could');
    $this->assertEqual($node->body->format, 'full_html');
    $this->assertEqual($node->getType(), 'article');
    $this->assertEqual($node->getTitle(), 'Test Post');
    $this->assertEqual($node->getCreatedTime(), 1237839334);
    $this->assertEqual($node->isSticky(), FALSE);
  }

}
