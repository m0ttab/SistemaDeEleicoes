@extends("base.index", ['title' => 'Períodos'])

@section("container")

    <h1>Períodos</h1>

    @if(count($periodos)==0)
        <p>Nenhum período cadastrado!</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Início</th>
                <th>Fim</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($periodos as $periodo)
        
            <tr id="per{{$periodo->id}}">
                <td>{{$periodo->nome}}</td>
                <td>{{date('d/m/Y', strtotime($periodo->dt_inicio))}}</td>
                <td>{{date('d/m/Y', strtotime($periodo->dt_fim))}}</td>
                <td><a class="btn btn-dark" href="/periodos/{{$periodo->id}}/edit">Editar</a></td>
                <td><a class="btn btn-dark" onclick="apagar({{$periodo->id}})">Remover</a></td>
            </tr>
            
        @endforeach
        </tbody>
    </table>
    @endif
    <a class="btn btn-primary" href="/periodos/create">Novo Período</a>
    <script>
        function apagar(id){

            if(confirm('Tem certeza que deseja excluir?')){

                fetch('/periodos/'+ id +'/destroy').then((req) => {
                
                    if(req.status == 200){
                        alert('Excluído com sucesso!');
                        document.getElementById('per'+id).remove();
                    }else{
                        alert('Erro ao excluir!');
                    }
                    
                });

            }
            
        }
    </script>

@endsection