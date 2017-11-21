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

        // get the existing data
        $allRows = $this->query(
            "SELECT loc.id AS loc_id, t.id AS type_id, i.name AS item_name, c.name AS cat_name
             FROM reuse_locations loc
             INNER JOIN reuse_locations_items rla ON rla.locatiON_id = loc.id
             INNER JOIN resource_type t ON t.id = rla.type
             INNER JOIN reuse_items i ON i.id = rla.item_id
             INNER JOIN reuse_categories c ON c.id = i.category_id;"
        )->fetchAll();

        // drop the foreign keys
        $locItems->dropForeignKey('item_id')
            ->save();

        $items->dropForeignKey('category_id')
            ->save();

        // delete everything from the offending tables
        $this->execute("DELETE FROM Reuse_Locations_Items");
        $this->execute("DELETE FROM Reuse_Items");
        $this->execute("DELETE FROM Reuse_Categories");

        // create the new table
        $itemsCats = $this->table("Reuse_Items_Categories");
        $itemsCats->addColumn("item_id", "integer", ['null' => false])
            ->addColumn('category_id', 'integer', ['null' => false])
            ->addForeignKey('item_id', 'Reuse_Items', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_rel_item_id'])
            ->addForeignKey('category_id', 'Reuse_Categories', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_rel_category_id'
            ])->save();

        // delete category_id reference in items
        $items->removeColumn('category_id')->save();

        // rename locations items column
        $locItems->renameColumn('item_id', 'item_cat_id')->save();

        // add fk constraint between locations items and items cats
        $locItems->addForeignKey('item_cat_id', 'Reuse_Items_Categories', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
            'constraint' => 'fk_rel_item_cat_id'
        ])->save();

        // process each row, reinserting into the db properly
        foreach ($allRows as $row) {

            // intialize variables
            $itemName = $row['item_name'];
            $categoryName = $row['cat_name'];
            $locationId = $row['loc_id'];
            $typeId = $row['type_id'];
            $itemId = -1;
            $catId = -1;
            $itemCatId = -1;

            $count = $this->fetchAll("SELECT id FROM Reuse_Items WHERE name = '$itemName'");

            print_r("\n\nID'S WHERE ITEM NAME = $itemName\n\n");
            print_r($count);
            print_r("The count = " . count($count) . "\n");

            // save the item / category id if exists or create new rows and save ids for those
            if (count($count) == 0) {
                $items->insert(['name' => $itemName])->saveData();
            }

            $res = $this->fetchRow("SELECT id FROM Reuse_Items WHERE name = '$itemName';");
            $itemId = $res['id'];

            $count = $this->fetchAll("SELECT id FROM Reuse_Categories WHERE name = '$categoryName';");

            if (count($count) === 0) {
                $cats->insert(['name' => $categoryName])->saveData();
            }

            $res = $this->fetchRow("SELECT id FROM Reuse_Categories WHERE name = '$categoryName';");
            $catId = $res['id'];

            $count = $this->fetchAll("SELECT id FROM Reuse_Items_Categories WHERE item_id = $itemId AND category_id = $catId;");

            if (count($count) === 0) {
                $itemsCats->insert([
                    'item_id' => $itemId,
                    'category_id' => $catId
                ])->saveData();
            }

            $res = $this->fetchRow("SELECT id FROM Reuse_Items_Categories WHERE item_id = $itemId AND category_id = $catId;");

            $itemCatId = $res['id'];

            // insert the record into locations items now that we've got what we need
            $locItems->insert([
                'location_id' => $locationId,
                'item_cat_id' => $itemCatId,
                'Type' => $typeId
            ])->save();
        }
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
