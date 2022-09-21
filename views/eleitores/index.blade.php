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
        @foreach($eleitores as $eleitor)
        
            <tr id="el{{$eleitor->id}}">
                <td>{{$eleitor->nome}}</td>
                <td>{{$eleitor->titulo}}</td>
                <td>{{$eleitor->zona}}</td>
                <td>{{$eleitor->secao}}</td>
                <td><a class="btn btn-dark" href="/eleitores/{{$eleitor->id}}/edit">Editar</a></td>
                <td><a class="btn btn-danger" onclick="apagar({{$eleitor->id}})">Remover</a></td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    @endif
    <a class="btn btn-primary" href="/eleitores/create">Novo Eleitor</a>
    <script>
        function apagar(id){
            if(confirm('Tem certeza que deseja excluir?')){

                fetch('/eleitores/'+ id +'/destroy').then((req) => {

                    if(req.status == 200){
                        alert('Excluído com sucesso!');
                        document.getElementById('el'+id).remove();
                    }else{
                        alert('Erro ao excluir!');
                    }
                    
                });

            }
        }
    </script>

@endsection
