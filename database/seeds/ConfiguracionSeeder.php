<?php

use Illuminate\Database\Seeder;
use App\configuracion;
class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        configuracion::create([
            'state' => 0,
            'intervalo_min' => 60,
            'llamadas_intervalo' => 3,
            'email' => '',
        ]); 
    }
}
