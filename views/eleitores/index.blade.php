@extends("base.index", ['title' => 'Eleitores'])

@section("container")

    <h1>Eleitores</h1>

    @if(count($eleitores)==0)
        <p>Nenhum eleitor cadastrado!</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Título</th>
                <th>Zona</th>
                <th>Seção</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($eleitor as $eleitor)
        
            <tr id="per{{$periodo->id}}">
                <td>{{$eleitor->nome}}</td>
                <td>{{$eleitor->titulo}}</td>
                <td>{{$eleitor->zona}}</td>
                <td>{{$eleitor->secao}}</td>
                <td><a class="btn btn-dark" href="/periodos/{{$periodo->id}}/edit">Editar</a></td>
                <td><a class="btn btn-dark" onclick="apagar({{$periodo->id}})">Remover</a></td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    @endif
    <a class="btn btn-primary" href="/eleitores/create">Novo Eleitor</a>
    <script>
        function apagar(id){
            fetch('/eleitores/'+ id +'/destroy').then((req) => {
                
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