<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');
        $table
            ->addTimestamps()
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addColumn('username', 'string', ['null' => false])
            ->addColumn('password', 'string', ['null' => false])
            ->addIndex(['username'], ['unique' => true])
            ->create();
    }
}
