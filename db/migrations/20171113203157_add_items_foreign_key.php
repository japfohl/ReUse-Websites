<?php


use Phinx\Migration\AbstractMigration;

class AddItemsForeignKey extends AbstractMigration
{
    public function up()
    {
        $this->execute("ALTER TABLE Reuse_Items DROP KEY category_id");

        $this->table("Reuse_Items")
            ->addForeignKey('category_id', 'Reuse_Categories', 'id', [
                'delete' => "CASCADE",
                'update' => "NO_ACTION",
                'constraint' => 'fk_category_id'
            ])->save();
    }

    public function down()
    {
        $this->table("Reuse_Items")
            ->dropForeignKey('category_id')
            ->save();

        $this->execute("ALTER TABLE Reuse_Items ADD KEY category_id (category_id)");
    }
}
