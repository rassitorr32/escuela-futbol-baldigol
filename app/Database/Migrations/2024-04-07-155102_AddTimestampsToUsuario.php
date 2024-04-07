<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToUsuario extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuario', [
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuario', 'created_at');
        $this->forge->dropColumn('usuario', 'updated_at');
        $this->forge->dropColumn('usuario', 'deleted_at');
    }
}
