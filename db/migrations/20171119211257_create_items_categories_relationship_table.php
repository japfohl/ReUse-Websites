<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Phinx\Migration\AbstractMigration;

class CreateItemsCategoriesRelationshipTable extends AbstractMigration
{
    public function up()
    {
        // create the table for the relationship
        $this->table('Reuse_Items_Categories')
            ->addColumn('item_id', 'integer')
            ->addColumn('category_id', 'integer')
            ->addForeignKey('item_id', 'Reuse_Items', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_rel_item_id'])
            ->addForeignKey('category_id', 'Reuse_Categories', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_rel_category_id'
            ])
            ->save();
    }

    public function down()
    {
        // drop the fk constraints
        $this->table('Reuse_Items_Categories')
            ->dropForeignKey('item_id')
            ->dropForeignKey('category_id')
            ->save();

        // drop the table
        $this->dropTable('Reuse_Items_Categories');
    }
}
