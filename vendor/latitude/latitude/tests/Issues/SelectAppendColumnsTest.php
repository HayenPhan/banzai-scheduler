<?php

namespace Latitude\QueryBuilder\Issues;

use Latitude\QueryBuilder\TestCase;

/**
 * @link https://github.com/shadowhand/latitude/issues/58
 */
class SelectAppendColumnsTest extends TestCase
{
    public function testSelectStar()
    {
        $query = $this->factory->select()->from('users');

        $this->assertSql('SELECT * FROM users', $query);
    }

    public function testSelectReplaceColumns()
    {
        $query = $this->factory->select()->columns('id')->from('users');

        $this->assertSql('SELECT id FROM users', $query);
    }

    public function testSelectAppendColumns()
    {
        $query = $this->factory->select()->addColumns('id', 'username')->from('users');

        $this->assertSql('SELECT id, username FROM users', $query);
    }
}
