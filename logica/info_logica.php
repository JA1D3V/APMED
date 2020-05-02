<?php

$g = $_GET;
include("config.php");

function info($id, $tipo) {
  global $db, $g;
  $sql = "SELECT * FROM {$tipo} WHERE id{$tipo} = '$id'";
  $acao = $db->query($sql);
  if ($acao == true) {
    $dados = $acao->fetch_array(MYSQLI_ASSOC);
    $entidade = new stdClass;
    if ($tipo == 'Medico') {
      $entidade->crm = $dados["crmMedico"];
    }
    $entidade->cpf = $dados["cpf{$tipo}"];
    $entidade->nome = $dados["nome{$tipo}"];
    $entidade->nasc = $dados["nasc{$tipo}"];
    $entidade->end = $dados["end{$tipo}"];
    $entidade->email = $dados["email{$tipo}"];
    $entidade->tel = $dados["tel{$tipo}"];
    echo json_encode($entidade);
  } else {
    return "ERRO_DB";
  }
}

function infoProntuario($id) {
  global $db;
  $sql = "SELECT * FROM Prontuario WHERE idProntuario = '$id'";
  $acao = $db->query($sql);
  if ($acao == true) {
    $dados = $acao->fetch_object();
    $prontuario = new stdClass;
    $prontuario->id = $dados->idProntuario;
    $prontuario->desc = $dados->DeProntuario;
    $prontuario->nome = $dados->nomePaciente;
    $prontuario->nasc = $dados->nascPaciente;
    $prontuario->peso = $dados->pesoPaciente;
    $prontuario->idade = $dados->idadePaciente;
    echo json_encode($prontuario);
  } else {
    echo "ERRO_DB";
  }
}

function infoConsulta($id) {
  global $db;
  $sql = "SELECT * FROM Consulta
   INNER JOIN Medico ON Consulta.Medico_idMedico = Medico.idMedico 
   INNER JOIN Paciente ON Consulta.Paciente_idPaciente = Paciente.idPaciente 
   INNER JOIN Prontuario ON Consulta.Prontuario_idProntuario = Prontuario.idProntuario
   WHERE idConsulta = '$id'";
  $acao = $db->query($sql);
  if ($acao == true) {
    $dados = $acao->fetch_object();
    $consulta = new stdClass;
    $consulta->id = $dados->idConsulta;
    $consulta->status = $dados->statusConsulta;
    $consulta->prioridade = $dados->prioridadeConsulta;
    $consulta->medico = $dados->nomeMedico;
    $consulta->paciente = $dados->nomePaciente;
    $consulta->prontuario = $dados->DeProntuario;
    $consulta->data = $dados->dataConsulta;
    $consulta->horario = $dados->horaConsulta;
    echo json_encode($consulta);
  } else {
    echo "ERRO_DB";
  }
}

if (isset($g["tipo"])) {
  if ($g["tipo"] == "medico") {
    info($g["id"], 'Medico');
  } else if ($g["tipo"] == "paciente") {
    info($g["id"], 'Paciente');
  } else if ($g["tipo"] == "funcionario") {
    info($g["id"], 'Funcionario');
  } else if ($g["tipo"] == "prontuario") {
    infoProntuario($g["id"]);
  } else if ($g["tipo"] == "consulta") {
    infoConsulta($g["id"]);
  } else {
    echo "Tipo desconhecido";
  }
} else {
  echo "Por favor, informe um tipo";
}

?>