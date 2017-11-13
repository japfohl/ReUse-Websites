<?php


use Phinx\Migration\AbstractMigration;

class AddLocationsForeignKey extends AbstractMigration {

    public function up() {

        // get rid of the useless key
        $this->execute(
            "ALTER TABLE Reuse_Locations
             DROP KEY state_id;");

        $this->table('Reuse_Locations')
            ->addForeignKey('state_id', 'States', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION',
                'constraint' => 'fk_state_id'
            ])->save();
    }

    public function down() {

        // drop the foreign key
        $this->table('Reuse_Locations')
            ->dropForeignKey('state_id', [
                'constraint' => 'fk_state_id'
            ])->save();

        // add key
        $this->execute(
            "ALTER TABLE Reuse_Locations
             ADD KEY state_id (state_id);"
        );
    }
}
