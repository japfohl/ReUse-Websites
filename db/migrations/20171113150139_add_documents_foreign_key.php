<?php


use Phinx\Migration\AbstractMigration;

class AddDocumentsForeignKey extends AbstractMigration
{
    public function up()
    {
        // drop the useless key
        $this->execute("ALTER TABLE Reuse_Documents DROP KEY location_id;");

        // add the foreign key
        $this->table("Reuse_Documents")
            ->addForeignKey('location_id', 'Reuse_Locations', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_location_id'
            ])->save();
    }

    public function down()
    {
        // drop the foreign key
        $this->table('Reuse_Documents')
            ->dropForeignKey('location_id')
            ->save();

        // add the original key
        $this->execute("ALTER TABLE Reuse_Documents ADD KEY location_id (location_id);");
    }
}
