<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToPago extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pago', [
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pago', 'created_at');
        $this->forge->dropColumn('pago', 'updated_at');
        $this->forge->dropColumn('pago', 'deleted_at');
    }
}
