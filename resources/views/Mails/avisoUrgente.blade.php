<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aviso urgente</title>
</head>
<body>
    <div class="title mb-4" style="font-size: 21px">Llamada urgente de atender</div>
    <div class="numero" style="font-size: 14px; margin-bottom: 20px">
      EL cliente con Número de teléfono
      <i
        class="fa-solid fa-phone-xmark shaking-icon"
        style="cursor: pointer; margin-right: 2px"
      ></i>
      <strong>{{ $ultimaLlamada->numero_llamante }}</strong> ha llamado
      <strong>{{ $configuracion->llamadas_intervalo }} </strong> veces sin ser
      atendido 
      {{-- al departamento
      <strong v-if="$parent.grupo.cola">{{ $parent.grupo.cola.cola }}</strong> --}}
      Durante el intervalo de
      <strong>{{ $configuracion->intervalo_min }} minutos</strong>.
    </div>
</body>
</html>