<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddAuthorsTable extends AbstractMigration
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
        // create the table
        $table = $this->table('authors', ['id' => 'author_id', 'signed' => true, ]);
        $table->addColumn('name', 'string', [ 'limit'=>255, 'null'=>false ] )
                
              ->addColumn('m_timestamp', 'timestamp', [ 'null'=>false, 'default'=>'CURRENT_TIMESTAMP' ] )
              ->addColumn('date_created', 'timestamp', [ 'null'=>false, 'default'=>'CURRENT_TIMESTAMP' ] )
                
              ->addIndex(
                ['name'], 
                [
                    'unique' => true,
                    'name' => 'idx_unq_authors_name'
                ]
              )
                
              ->create();
        
        if($this->isMigratingUp()) {
            
            $faker = \Faker\Factory::create();
            
            // 20 x 500 = 10k records. 
            // Need inner loop because sqlite can only handle 500 records 
            // each with one field in one bulk insert operation at a time.
            for($i=0; $i <= 19; $i++) {
                
                $data = [];
                
                for($j=0; $j <= 499; $j++) {

                    $data[] = [ 'name' => $faker->name() . "{$i}{$j}" ];
                }

                $table->insert($data)->save();
            }
        }
    }
}
