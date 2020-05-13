<?php

include('../logica/config.php');

$sql = "select * from Consulta inner join Medico on Consulta.Medico_idMedico = Medico.idMedico inner join Paciente on Consulta.Paciente_idPaciente = Paciente.idPaciente;";
$act = $db->query($sql);
if ($act == true) {
  $nr = $act->num_rows;
}

?>
<div class="ctn-holder">
  <h1>Consultas</h1>
  <div class="controls">
    <button class="btn btn-success">Adicionar nova consulta</button>
  </div>
  <div class="table-holder">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Status</th>
          <th scope="col">Prioridade</th>
          <th scope="col">Médico</th>
          <th scope="col">Pàciente</th>
          <th scope="col">Data</th>
          <th scope="col">Hora</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
    
          if (isset($nr)) {
            for ($a = 0; $a < $nr; $a++) {
              $fetch = $act->fetch_object();
              echo "<tr>";
              echo "<td>{$fetch->statusConsulta}</td>";
              echo "<td>{$fetch->prioridadeConsulta}</td>";
              echo "<td>{$fetch->nomeMedico}</td>";
              echo "<td>{$fetch->nomePaciente}</td>";
              echo "<td>{$fetch->dataConsulta}</td>";
              echo "<td>{$fetch->horaConsulta}</td>";
              echo "<td><button class='btn btn-primary'>Editar</button></td>";
              echo "</tr>";
            }
          }
        
        ?>
      </tbody>
    </table>
  </div>
</div>