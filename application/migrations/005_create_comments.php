<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Comments extends CI_Migration
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

      'post_id'=>array(
        'type'=>'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
      ),

      'name'=>array(
        'type'=>'VARCHAR',
        'constraint' => 255,
      ),

      'email'=>array(
        'type'=>'VARCHAR',
        'constraint' => 100,
      ),

      'comment'=>array(
        'type'=>'TEXT',
      ),

      'aproved'=>array(
        'type'=>'TINYINT',
        'constraint' => 1,
      ),

     'created_at'=>array(
        'type'=>'TIMESTAMP',
      )

    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('comments');
  }

}
