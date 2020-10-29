<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Posts extends CI_Migration
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

      'cat_id'=>array(
        'type'=>'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
      ),

      'title'=>array(
        'type'=>'VARCHAR',
        'constraint' => 255,
      ),

      'slug'=>array(
        'type'=>'VARCHAR',
        'constraint' => 128,
        'unique' => TRUE,
      ),

      'description'=>array(
        'type'=>'VARCHAR',
        'constraint' => 255,
      ),

      'content'=>array(
        'type'=>'TEXT',
      ),

      'post_image'=>array(
        'type'=>'VARCHAR',
        'constraint' => 255,
      ),

     'created_at'=>array(
        'type'=>'TIMESTAMP',
        'default' => NULL
      ),

     'updated_at'=>array(
        'type'=>'TIMESTAMP',
      ),

    ));
    
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('posts');
  }

}