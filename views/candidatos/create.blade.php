@extends("base.index", ['title' => 'Cadastrar Candidato'])

@section("container")

<h1>Cadastrar Candidato</h1>

<form method="POST" action="/eleicoes/public/candidatos/store" id="form">
    <input type='hidden' name='_token' value='{{csrf_token()}}'/>
    <div class="form-group">
        <label>Nome:</label>
        <input class="form-control" type='text' name='nome' placeholder="Informe o nome"/>
    </div>
    <div class="form-group">
        <label>Partido:</label>
        <input class="form-control" type='text' name='partido' placeholder="Informe o partido"/>
    </div>
    <div class="form-group">
        <label>Número:</label>
        <input class="form-control" type='number' name='numero' placeholder="informe o número"/>
    </div>
    <div class="form-group">
        <label>Cargo:</label>
        <select class="form-control" id="cargo" name="cargo">
        <option>Selecione o Cargo</option>
        <option value="presidente">Presidente</option>
        <!--
        <option value="governador">Governador</option>
        <option value="dep_fed">Deputado Federal</option>
        <option value="dep_est">Deputado Estadual</option>
        <option value="senador">Senador</option>
-->
       </select> 
    </div>
    <div class="form-group">
      <label>Período:</label>
      <select class="form-control" id="periodos" name="periodo">
        <option value="">Selecione o Período</option>
      </select>    
    </div>
    <button class="btn btn-dark" type='submit'>Enviar</button>
    <button class="btn btn-dark" type='reset'>Cancelar</button>
    <a class="btn btn-dark" href="/candidatos">Voltar</a>
</form>

<script>

  async function getPeriodos(){
    const req = await fetch('/api/periodos');
    const res = await req.json();
    for(const periodo of res){
        
        var opt = document.createElement('option');
        opt.innerHTML = periodo.nome;
        opt.setAttribute('value', periodo.id);
        document.getElementById('periodos').appendChild(opt);
        
    }
  }

  getPeriodos();

  document.getElementById('form').onsubmit = (e) => {
      
    e.preventDefault();
    var form_data = new FormData(document.getElementById('form'));
      
    fetch('/candidatos/store', {
        
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