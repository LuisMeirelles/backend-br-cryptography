<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserInfoTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('user_infos')
            ->addColumn('user_document', 'string', ['limit' => 255])
            ->addColumn('credit_card_token', 'string', ['limit' => 255])
            ->addColumn('value', 'biginteger')
            ->create();
    }
}
