<?php

declare(strict_types=1);

use App\Infrastructure\Database\DatabaseTables;
use Phinx\Migration\AbstractMigration;

final class CreateUserTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table(DatabaseTables::USERS->value);
        $table
            ->addTimestamps()
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addColumn('username', 'string', ['null' => false])
            ->addColumn('password', 'string', ['null' => false])
            ->addIndex(['username'], ['unique' => true])
            ->create();
    }
}
