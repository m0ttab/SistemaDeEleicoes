@extends("base.index", ['title' => 'Candidatos'])

@section("container")

    <h1>Candidatos</h1>

    @if(count($candidatos)==0)
        <p>Nenhum candidato cadastrado!</p>
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
        @foreach($candidatos as $candidato)
        
            <tr id="can{{$candidato->id}}">
                <td>{{$candidato->nome}}</td>
                <td>{{$candidato->partido}}</td>
                <td>{{$candidato->numero}}</td>
                <td>{{$candidato->cargo}}</td>
                <td>{{$candidato->periodo}}</td>
                <td><a class="btn btn-dark" href="/candidatos/{{$candidato->id}}/edit">Editar</a></td>
                <td><a class="btn btn-dark" onclick="apagar({{$candidato->id}})">Remover</a></td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    @endif
    <a class="btn btn-primary" href="/candidatos/create">Novo Candidato</a>
    <script>
        function apagar(id){
            if(confirm('Tem certeza que deseja excluir?')){

                fetch('/candidatos/'+ id +'/destroy').then((req) => {

                    if(req.status == 200){
                        alert('Excluído com sucesso!');
                        document.getElementById('can'+id).remove();
                    }else{
                        alert('Erro ao excluir!');
                    }
                    
                });

            }
        }
    </script>

@endsection