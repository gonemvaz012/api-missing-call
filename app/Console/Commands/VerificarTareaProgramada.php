<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\configuracion;
use App\Llamadas;
use Carbon\Carbon;
use App\Mail\avisoUrgente;
use Illuminate\Support\Facades\Mail;


class VerificarTareaProgramada extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
{
    return true;
    // Obtener la configuración
    $configuracion = configuracion::find(1);
    
    $intervalo = $configuracion->intervalo_min;
    $repeticionesMinimas = intval($configuracion->llamadas_intervalo);// Obtener el valor dinámico

    // Calcular el rango de tiempo
    $horaActual = Carbon::now();
    $horaInicioRango = $horaActual->copy()->subMinutes($intervalo); // Retroceder el intervalo

    \Log::info($horaInicioRango . ' ' . ' hora Inicio Rango');

    // Consulta para obtener las llamadas dentro del rango de tiempo
    $llamadas = Llamadas::whereBetween('created_at', [$horaInicioRango, $horaActual])
        ->get();

    \Log::info($horaActual . ' ' . ' Hora actual');
    \Log::info($llamadas . ' ' . ' Llamadas en rango');

    // Verificar si hay llamadas disponibles
    if ($llamadas->count() > 0) {

        // Agrupar las llamadas por número y contar cuántas veces se repite cada número
        $llamadasAgrupadas = $llamadas->groupBy('numero_llamante')->map(function ($grupo) use ($repeticionesMinimas) {
            return [
                'numero_llamante' => $grupo->first()->numero_llamante,
                'repeticiones' => count($grupo),
                'llamadas' => $grupo
            ];
        })->filter(function ($grupo) use ($repeticionesMinimas) {
            return $grupo['repeticiones'] >= $repeticionesMinimas; // Filtrar solo los números que se repiten al menos 3 veces
        })->values(); // Reindexar el array

        \Log::info($llamadasAgrupadas);

        foreach ($llamadasAgrupadas as $grupo) {
            $ultimaLlamada = $grupo['llamadas']->last();
            $ultimaLlamadaId = $ultimaLlamada->id_llamada_estado;
            foreach ($grupo['llamadas'] as $llamada) {
                $llamada->grupo_id = $ultimaLlamadaId;
                $llamada->save();
            }

            // Obtener las llamadas anteriores al último y actualizar el campo no_visible a true
            $cantidadAnteriores = min($repeticionesMinimas - 1, $grupo['llamadas']->count() - 1);
            $llamadasAnteriores = $grupo['llamadas']->reverse()->slice(1, $cantidadAnteriores); // Obtener las anteriores
            foreach ($llamadasAnteriores as $llamadaAnterior) {
                $llamadaAnterior->no_visible = true;
                $llamadaAnterior->save();
            }

           // Mail::to($configuracion->email)->send(new avisoUrgente($ultimaLlamada, $configuracion));
        }
    } else {
        \Log::info('vacio');
    }
}

}
