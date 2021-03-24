<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTable([
            'users',
            'posts',
            'comments',
            //'routines',
        ]);

        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }

    protected function truncateTable(array $tables){

        /* Desactivar la revisión de claves ajenas para que no de problemas 
        al eliminar la tabla */
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        /* Se vacia la tabla para que no de error al crear profesiones que 
        ya existen */
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        /* Se activa nuevamente la revisió de claves ajenas */
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
