<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'user',
                'password' => password_hash('user', PASSWORD_DEFAULT),
                'deleted_at' => date_create('now')->format('Y-m-d H:i:s'),
            ]
        ];

        $this->table('users')
            ->insert($data)
            ->saveData();
    }
}
