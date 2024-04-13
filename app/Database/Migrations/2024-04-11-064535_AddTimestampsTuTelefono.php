<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsTuTelefono extends Migration
{
    public function up()
    {
        $this->forge->addColumn('telefono', [
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('telefono', 'created_at');
        $this->forge->dropColumn('telefono', 'updated_at');
        $this->forge->dropColumn('telefono', 'deleted_at');
    }
}
