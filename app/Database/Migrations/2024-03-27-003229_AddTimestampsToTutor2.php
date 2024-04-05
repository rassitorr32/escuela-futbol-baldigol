<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToTutor2 extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tutor', [
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tutor', 'created_at');
        $this->forge->dropColumn('tutor', 'updated_at');
        $this->forge->dropColumn('tutor', 'deleted_at');
    }
}
