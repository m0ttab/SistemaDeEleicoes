@extends("base.index", ['title' => 'Votação'])

@section("container")

<h1>Votação</h1>

@if($permissao)

<form method="POST" action="/eleicoes/public/votacao/store" id="form">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="form-group">
    <input class="form-control" type="text" name="titulo" placeholder="Informe seu titulo de eleitor">
  </div>
  <div class="form-group">
    <input class="form-control" type="number" name="candidato" placeholder="Informe o número do seu candidato">
  </div>
  <div class="form-group">
    <button class="btn btn-warning" type="submit">Enviar</button>
    <button class="btn btn-danger" type='reset'>Cancelar</button>
  </div>
</form>
</div>
<script>
    
    // document.getElementById('form').onsubmit = (e) => {
      
    //     e.preventDefault();
    //     var form_data = new FormData(document.getElementById('form'));
        
    //     fetch('/votacao/store', {
          
    //       method: 'POST',
    //       body: form_data
          
    //     }).then((req) => {
          
    //       if(req.status == 200){

    //         req.json().then((res) => {

    //           alert(res.mensagem);
    //           document.getElementById('form').reset();

    //         });

    //       }else{
    //           alert('Erro no cadastro!');
    //       }
          
    //     });
    // }

</script>

@else

<p>Você está fora do período de inscrições!</p>

@endif

@endsection