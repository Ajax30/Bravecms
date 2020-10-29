<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Authors extends CI_Migration
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

      'first_name'=>array(
        'type'=>'VARCHAR',
        'constraint' => 50,
      ),

      'last_name'=>array(
        'type'=>'VARCHAR',
        'constraint' => 50,
      ),

      'email'=>array(
        'type'=>'VARCHAR',
        'constraint' => 100,
      ),

      'bio'=>array(
        'type'=>'TEXT',
      ),

      'avatar'=>array(
        'type'=>'VARCHAR',
        'constraint' => 255,
      ),

      'password'=>array(
        'type'=>'VARCHAR',
        'constraint' => 255,
      ),

      'active'=>array(
        'type'=>'TINYINT',
        'constraint' => 1,
      ),

      'is_admin'=>array(
        'type'=>'TINYINT',
        'constraint' => 1,
      ),

      'register_date'=>array(
        'type'=>'TIMESTAMP',
      )

    ));
    
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('authors');
  }

}
