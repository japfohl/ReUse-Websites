<?php


use Phinx\Migration\AbstractMigration;

class AddLocationsItemsForeignKeys extends AbstractMigration
{
    public function up()
    {
        $this->execute(
            "ALTER TABLE Reuse_Locations_Items
                 DROP PRIMARY KEY,
                 DROP KEY item_id,
                 DROP KEY Type;"
        );

        $this->execute(
            "ALTER TABLE Reuse_Locations_Items
                ADD id INT NOT NULL AUTO_INCREMENT PRIMARY KEY;"
        );

        $this->table('Reuse_Locations_Items')
            ->addForeignKey('location_id', 'Reuse_Locations', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_loc_id'])
            ->addForeignKey('item_id', 'Reuse_Items', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_item_id'])
            ->addForeignKey('Type', 'Resource_Type', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_type_id'])
            ->save();
    }

    public function down()
    {
        $this->table('Reuse_Locations_Items')
            ->dropForeignKey('location_id')
            ->dropForeignKey('item_id')
            ->dropForeignKey('Type')
            ->save();

        $this->execute(
            "ALTER TABLE Reuse_Locations_Items
                DROP PRIMARY KEY,
                DROP id;"
        );

        $this->execute(
            "ALTER TABLE Reuse_Locations_Items
                ADD PRIMARY KEY (location_id, item_id),
                ADD KEY item_id (item_id),
                ADD KEY Type (Type);"
        );
    }
}
