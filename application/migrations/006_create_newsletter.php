<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Newsletter extends CI_Migration
{

  public function up()
  {
    $this->dbforge->add_field(array(
      'id'=>array(
        'type'=>'INT',
        'constraint' => 6,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      
      'email'=>array(
        'type'=>'VARCHAR',
        'constraint' => 100
      ),

     'subscription_date'=>array(
        'type'=>'TIMESTAMP'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('newsletter');
  }

}
