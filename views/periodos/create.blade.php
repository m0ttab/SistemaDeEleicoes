@extends("base.index", ['title' => 'Cadastrar Períodos'])

@section("container")

<h1>Cadastrar Período</h1>

<form id="form">
    <input type='hidden' name='_token' value='{{csrf_token()}}'/>
    <div class="form-group">
        <label>Nome:</label>
        <input class="form-control" type='text' name='nome' placeholder="Informe o nome"/>
    </div>
    <div class="form-group">
        <label>Início:</label>
        <input class="form-control" type='datetime-local' name='dt_inicio' id="dt_inicio"/>
    </div>
    <div class="form-group">
        <label>Fim:</label>
        <input class="form-control" type='datetime-local' name='dt_fim' id="dt_fim"/>
    </div>
    <button class="btn btn-dark" type='submit'>Enviar</button>
    <button class="btn btn-dark" type='reset'>Cancelar</button>
    <a class="btn btn-dark" href="/periodos">Voltar</a>
</form>
<script>
    document.getElementById('form').onsubmit = (e) => {
      
      e.preventDefault();
      var form_data = new FormData(document.getElementById('form'));
      
      fetch('/periodos/store', {
        
        method: 'POST',
        body: form_data
        
      }).then((req) => {
        
        if(req.status == 200){
            alert('Formulário enviado!');
            document.getElementById('form').reset();
        }else{
            alert('Erro no cadastro!');
        }
        
      });
  }
</script>

@endsection