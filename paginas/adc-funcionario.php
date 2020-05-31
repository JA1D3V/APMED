<?php

?>
<style>
  @import '../extras/styles/main.css';
  .smoll {
    width: 100% !important;
  }
</style>
<div class="ctn-holder">
<h1>Cadastro funcionário</h1>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <select name="unidade" id="unidade" class="ipt">
        <option value="und" selected>Unidade</option>
        <option value="matriz">Matriz</option>
      </select>
      <input type="text" id="cpf" class="ipt" placeholder="CPF">
      <input type="text" id="nome" class="ipt" placeholder="Nome">
      <input type="email" id="email" class="ipt" placeholder="E-mail">
      <input type="text" id="tel" class="ipt" placeholder="Fone">
      <input type="text" id="nasc" class="ipt" placeholder="Data de nascimento">
      <div class="row">
        <div class="col-md-6">
          <input type="text" id="end" class="ipt smoll" placeholder="CEP">
        </div>
        <div class="col-md-3">
          <input type="text" style="margin-left: 0 !important" class="ipt smoll" placeholder="N°">
        </div>
      </div>
      <input type="text" class="ipt" placeholder="Complementos">
    </div>
    <div class="col-md-6">
      <select class="ipt" id="tipo">
        <option value="x">Função</option>
        <option value="medico">Médico</option>
        <option value="funcionario">Funcionário</option>
      </select>
      <input type="text" id="crm" class="ipt" placeholder="CRM (caso explique)">
      <h3><b>Dados de acesso</b></h3>
      <input type="password" id="senha" class="ipt" placeholder="Senha">
    </div>
  </div>
  <div style="width: 100%; text-align: center">
    <button class="btn" onclick="send()">Cadastrar</button>
  </div>
</div>
</div>
<script src="bin/vendor/jquery/jquery.min.js"></script>
<script src="bin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  if (window.location.search.split('=')[1] == 'adc-funcionario') {
    $('#cpf').mask('000.000.000-00', {reverse: true});

    $('#tel').mask('(00) 00000-0000');

    $('#nasc').mask('00/00/0000', {reverse: true});

    $('#end').mask('00000-000', {reverse: true});
  }

  function send() {
    let sendobj = {
      tipo: document.getElementById('tipo').value,
      cpf: document.getElementById('cpf').value,
      nome: document.getElementById('nome').value,
      nasc: document.getElementById('nasc').value,
      end: document.getElementById('end').value,
      tel: document.getElementById('tel').value,
      email: document.getElementById('email').value,
      senha: document.getElementById('senha').value
    }
    if (document.getElementById('crm').value) {
      sendobj.crm = document.getElementById('crm').value
    }

    axios.post('/logica/cadastro_logica.php', sendobj)
      .then(x => {
        if (x.data == "ok!") {
          alert("Dados inseridos com sucesso!")
          window.location.href = `${window.location.origin}/paginas/dashboard.php`
        }
      })
      .catch(e => {
        console.log(e)
        alert('Não foi possível escrever os dados')
      })

  }
</script>