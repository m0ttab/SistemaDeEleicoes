@extends("base.index", ['title' => 'Comprovante']) 
  
 @section("container")
 
 <h1>Comprovante de Votação</h1>
 
 @if(!empty($mensagem))
 
 <p>{{$mensagem}}</p>
 
 @elseif(!empty($candidatos))
 
 <p>Confira os candidatos nos quais você votou!</p>
 
 <table class="table">
    <thead>
      <tr>
        <th>Presidente</th>
        <th>Governador</th>
        <th>Senador</th>
        <th>Deputado Estadual</th>
        <th>Deputado Federal</th>
      </tr>
    </thead>
    <tbody>
      
      <tr>
        <td>{{$candidatos['presidente']}}</td>
        <td>{{$candidatos['governador']}}</td>
        <td>{{$candidatos['senador']}}</td>
        <td>{{$candidatos['deputado_estadual']}}</td>
        <td>{{$candidatos['deputado_federal']}}</td>
      </tr>
    
    </tbody>
  </table>
  
@endif

<a class="btn btn-primary" href="">Acompanhar resultados</a>
  
@endsection