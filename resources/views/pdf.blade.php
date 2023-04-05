<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRice</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      #documentTitle{
        text-align: center;
      }



    </style>
</head>
<body>
  <div id='documentTitle'><h1>Projeto de Software Gerado por PRice</h1></div>
	@foreach($projects as $p)
    <ul class="list-group">
      <li class="list-group-item active">
        <strong>{{ $p->name }}</strong><br>
        @if(count($p->task))
          <ul class="list-group">
            @foreach($p->task as $r)
                <li class="list-group-item"><strong>Título</strong>: {{ $r->name }}<br>
                <small><strong>Descrição</strong>: {{ $r->description }}</small><br>
                <small><strong>Arquivos lógicos internos (mudanças no banco de dados)</strong>: {{ $r->ali_justify ?? 'Sem justificativa' }}</small><br>
                <small><strong>Arquivos de interface externa (mudanças no banco de dados de outra aplicação)</strong>: {{ $r->aie_justify ?? 'Sem justificativa' }}</small><br>
                <small><strong>Entradas Externas (mudanças em registros no banco de dados)</strong>: {{ $r->ee_justify ?? 'Sem justificativa' }}</small><br>
                <small><strong>Saídas Externas (consultas com processamento no banco de dados)</strong>: {{ $r->se_justify ?? 'Sem justificativa'}}</small><br>
                <small><strong>Consultas Externas (consultas sem processamento no banco de dados)</strong>: {{ $r->ce_justify ?? 'Sem justificativa' }}</small><br>
                <strong>Total: {{ $r->fp_total_amount ?? 0 }} PF</strong></li><br><br>
            @endforeach
          </ul>
        @else
          Sem tarefas cadastrados.
        @endif
        <br>
      </li>
    </ul>
		<br>
	@endforeach
</body>
</html>