<?php

use Illuminate\Database\Seeder;

class TipoPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('tipo_posts')->truncate();

        DB::table('tipo_posts')->insert([
            'name' 	=> 'General'
        ]);

        DB::table('tipo_posts')->insert([
            'name' 	=> 'Cumpleaños'
        ]);

        DB::table('tipo_posts')->insert([
            'name' 	=> 'Importante'
        ]);

        DB::table('tipo_posts')->insert([
            'name' 	=> 'Eventos'
        ]);

        DB::table('tipo_posts')->insert([
            'name' 	=> 'Informaciones'
        ]);        
    }
}
