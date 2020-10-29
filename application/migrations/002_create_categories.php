<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Categories extends CI_Migration
{

  public function up()
  {
    $this->dbforge->add_field(array(
      'id'=>array(
        'type'=>'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),

      'author_id'=>array(
        'type'=>'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
      ),

      'name'=>array(
        'type'=>'VARCHAR',
        'constraint' => 255,
      ),

      'created_at'=>array(
        'type'=>'TIMESTAMP',
      )

    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('categories');
    $data = array(
      'author_id'    => 1,
      'name'         => 'Uncategorized',
      'created_at' => date('Y-m-d H:i:s') 
    );

    $this->db->insert('categories', $data);
  }

}
