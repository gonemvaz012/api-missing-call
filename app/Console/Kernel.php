<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\configuracion;
use Carbon\Carbon;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */


     protected function schedule(Schedule $schedule)
     {

        return true;

         $configuracion = configuracion::find(1);
     
         if ($configuracion && $configuracion->state && $configuracion->intervalo_min) {
             $intervalo = $configuracion->intervalo_min;
     
             $schedule->call(function () use ($intervalo) {
                 // Obtener la hora actual
                 $horaActual = Carbon::now();
                 
                 // Verificar si la hora actual está en un múltiplo del intervalo
                 if ($horaActual->minute % $intervalo === 0) {
                     // Ejecutar tu tarea programada aquí...
                    //  \Artisan::call('verificar');
                      
                     \Log::info("Tarea programada verificada. Intervalo: $intervalo minutos. Hora: " . $horaActual->format('H:i'));
                 } else {
                     \Log::info("No se ejecuta la tarea programada. No es un múltiplo del intervalo de $intervalo minutos. Hora: " . $horaActual->format('H:i'));
                 }
             })->everyMinute();
         } else {
             \Log::error('No se pudo obtener el intervalo de minutos de la configuración.');
         }
     }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
