@extends("base.index", ['title' => 'Candidatos'])

@section("container")

    <h1>Candidatos</h1>

    @if(count($periodos)==0)
        <p>Nenhum eleitor cadastrado!</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Partido</th>
                <th>Número</th>
                <th>Cargo</th>
                <th>Período</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($periodos as $periodo)
        
            <tr id="per{{$periodo->id}}">
                <td>{{$candidato->nome}}</td>
                <td>{{$candidato->partido}}</td>
                <td>{{$candidato->numero}}</td>
                <td>{{$candidato->cargo}}</td>
                <td>{{$candidato->periodo}}</td>
                <td><a class="btn btn-dark" href="/periodos/{{$periodo->id}}/edit">Editar</a></td>
                <td><a class="btn btn-dark" onclick="apagar({{$periodo->id}})">Remover</a></td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    @endif
    <a class="btn btn-primary" href="/periodos/create">Novo Candidato</a>
    <script>
        function apagar(id){
            fetch('/candidatos/'+ id +'/destroy').then((req) => {
                
                if(req.status == 200){
                    alert('Excluído com sucesso!');
                    document.getElementById('per'+id).remove();
                }else{
                    alert('Erro ao excluir!');
                }
                
            });
        }
    </script>

@endsection