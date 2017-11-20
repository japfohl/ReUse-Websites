<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Phinx\Migration\AbstractMigration;

class CreateItemsCategoriesRelationshipTable extends AbstractMigration
{
    public function up()
    {
        // get the tables being modified
        $locItems = $this->table('Reuse_Locations_Items');
        $type = $this->table('Resource_Type');
        $items = $this->table('Reuse_Items');
        $cats = $this->table('Reuse_Categories');

        // drop the foreign keys
        $locItems->dropForeignKey('item_id')
            ->save();

        $items->dropForeignKey('category_id')
            ->save();
    }

    public function down()
    {
        // get the tables being modified
        $locItems = $this->table('Reuse_Locations_Items');
        $type = $this->table('Resource_Type');
        $items = $this->table('Reuse_Items');
        $cats = $this->table('Reuse_Categories');

        // restore the foreign keys
        $locItems->addForeignKey('item_id', 'Reuse_Items', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
            'constraint' => 'fk_item_id'
        ])->save();

        $items->addForeignKey('category_id', 'Reuse_Categories', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
            'constraint' => 'fk_category_id'
        ])->save();
    }
}
