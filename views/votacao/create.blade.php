@extends("base.index", ['title' => 'Votação'])

@section("container")

<h1>Votação</h1>

@if($permissao)

<form method="POST" action="votacao/store" id="form">

  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="form-group">
    <input class="form-control" type="text" name="titulo" placeholder="Informe seu titulo de eleitor">
  </div>
  <div class="form-group">
    <input class="form-control" type="number" name="presidente" placeholder="Informe o número do seu candidato a presidente">
  </div>
  <div class="form-group">
    <input class="form-control" type="number" name="governador" placeholder="Informe o número do seu candidato a governador">
  </div>
  <div class="form-group">
    <input class="form-control" type="number" name="senador" placeholder="Informe o número do seu candidato a senador">
  </div>
  <div class="form-group">
    <input class="form-control" type="number" name="deputado_estadual" placeholder="Informe o número do seu candidato a deputado estadual">
  </div>
  <div class="form-group">
    <input class="form-control" type="number" name="deputado_federal" placeholder="Informe o número do seu candidato a deputado federal">
  </div>
  <div class="form-group">
    <button class="btn btn-warning" type="submit">Enviar</button>
    <button class="btn btn-danger" type='reset'>Cancelar</button>
  </div>
</form>

@else

<p>Você está fora do período de inscrições!</p>

@endif

@endsection
