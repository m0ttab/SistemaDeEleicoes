@extends("base.index", ['title' => 'Cadastrar Eleitor'])

@section("container")

<h1>Cadastrar Eleitor</h1>

<form id="form">
    <input type='hidden' name='_token' value='{{csrf_token()}}'/>
    <div class="form-group">
        <label>Nome:</label>
        <input class="form-control" type='text' name='nome' placeholder="Informe o nome"/>
    </div>
    <div class="form-group">
        <label>Título:</label>
        <input class="form-control" type='number' name='titulo' placeholder="Informe o título"/>
    </div>
    <div class="form-group">
        <label>Zona:</label>
        <input class="form-control" type='text' name='zona' placeholder="Informe a zona"/>
    </div>
    <div class="form-group">
        <label>Seção:</label>
        <input class="form-control" type='text' name='secao' placeholder="Informe a seção"/>
    </div>
    <button class="btn btn-dark" type='submit'>Enviar</button>
    <button class="btn btn-dark" type='reset'>Cancelar</button>
    <a class="btn btn-dark" href="/eleitores">Voltar</a>
</form>
<script>
    document.getElementById('form').onsubmit = (e) => {
      
      e.preventDefault();
      var form_data = new FormData(document.getElementById('form'));
      
      fetch('/eleitores/store', {
        
        method: 'POST',
        body: form_data
        
      }).then((req) => {
        
        if(req.status == 200){
            req.json().then((res) => {

                alert(res.mensagem);
                document.getElementById('form').reset();

            });
        }else{
            alert('Erro no cadastro!');
        }
        
      });
  }
</script>

@endsection