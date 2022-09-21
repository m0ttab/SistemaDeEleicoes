@extends("base.index", ['title' => 'Resultado'])

@section("container")

<h1>Resultados vencedores</h1>

@if(!isset($resultadosFinais))

    <p>Não há nenhum voto!</p>

@else

<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Número</th>
            <th>Cargo</th>
            <th>Número de votos</th>
        </tr>
    </thead>
    <tbody>
        @foreach($resultadosFinais as $resultadoFinal)
        <tr>
            <td>{{$resultadoFinal->nome}}</td>
            <td>{{$resultadoFinal->candidato}}</td>
            <td>{{$resultadoFinal->cargo}}</td>
            <td>{{$resultadoFinal->number_of_votes}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@foreach($secoes as $secao)
<h1>Resultados da Seção {{$secao->secao}}</h1>

@foreach($zonas as $zona)
@if($zona->secao == $secao->secao)
<h2>Zona {{$zona->zona}}</h2>

<table class="table">
    <thead>
        <tr>
            <th>Candidato</th>
            <th>Número de votos</th>
        </tr>
    </thead>
    <tbody>
        @foreach($resultadosSecao as $resultado)
        @if($resultado->secao == $secao->secao && $resultado->zona == $zona->zona)
        <tr>
            <td>{{$resultado->candidato}}</td>
            <td>{{$resultado->number_of_votes}}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endif
@endforeach
@endforeach
@endif
@endsection