@extends("base.index", ['title' => 'Alterar Eleitor'])

@section("container")

<h1>Alterar Eleitor</h1>

<form id="form">
    <input type='hidden' name='_token' value='{{csrf_token()}}'/>
    <input type="hidden" value="{{ $periodo->id }}" name="id"/>
    <div class="form-group">
        <label>Nome:</label>
        <input class="form-control" type='text' name='nome' value="{{ $eleitor->nome }}" placeholder="Informe o nome"/>
    </div>
    <div class="form-group">
        <label>Título:</label>
        <input class="form-control" type='number' name='titulo' value="{{ $eleitor->titulo }}"/>
    </div>
    <div class="form-group">
        <label>Zona:</label>
        <input class="form-control" type='text' name='zona' placeholder="Informe a zona" value="{{ $eleitor->zona }}"/>
    </div>
    <div class="form-group">
        <label>Seção:</label>
        <input class="form-control" type='text' name='secao' placeholder="Informe a seção" value="{{ $eleitor->secao }}"/>
    </div>
    <button class="btn btn-dark" type='submit'>Alterar</button>
    <button class="btn btn-dark" type='reset'>Cancelar</button>
    <a class="btn btn-dark" href="/periodos">Voltar</a>
</form>
<script>
    document.getElementById('form').onsubmit = (e) => {
      
      e.preventDefault();
      var form_data = new FormData(document.getElementById('form'));
      
      fetch('/eleitores/update', {
        
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