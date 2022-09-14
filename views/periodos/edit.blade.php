@extends("base.index", ['title' => 'Alterar Período'])

@section("container")

<h1>Alterar Período</h1>

<form id="form">
    <input type='hidden' name='_token' value='{{csrf_token()}}'/>
    <input type="hidden" value="{{ $periodo->id }}" name="id"/>
    <div class="form-group">
        <label>Nome:</label>
        <input class="form-control" type='text' name='nome' value="{{ $periodo->nome }}" placeholder="Informe o nome"/>
    </div>
    <div class="form-group">
        <label>Início:</label>
        <input class="form-control" type='datetime-local' name='dt_inicio' value="{{ $periodo->dt_inicio }}"/>
    </div>
    <div class="form-group">
        <label>Fim:</label>
        <input class="form-control" type='datetime-local' name='dt_fim' value="{{ $periodo->dt_fim }}"/>
    </div>
    <button class="btn btn-dark" type='submit'>Alterar</button>
    <button class="btn btn-dark" type='reset'>Cancelar</button>
    <a class="btn btn-dark" href="/periodos">Voltar</a>
</form>
<script>
    document.getElementById('form').onsubmit = (e) => {
      
      e.preventDefault();
      var form_data = new FormData(document.getElementById('form'));
      
      fetch('/periodos/update', {
        
        method: 'POST',
        body: form_data
        
      }).then((req) => {
        
        if(req.status == 200){
            alert('Formulário enviado!');
        }else{
            alert('Erro no cadastro!');
        }
        
      });
  }
</script>

@endsection