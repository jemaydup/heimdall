<?php
include_once 'db.php';
//nclude '../../config/database.php';
//se debe setear el nuevo RP con co
$RP = 3911;
$update_limpia_guardia = 'update gda_persona, gda_grupo_persona, gda_grupo, gda_role set gda_persona.guardia = 0 where gda_grupo_persona.IDRole = gda_role.IDRole AND gda_grupo_persona.IdGrupo = gda_grupo.IDGrupo AND gda_grupo_persona.IDPersona = gda_persona.Legajo AND gda_grupo.Activo = 1 AND gda_persona.Status= 1 and gda_persona.Guardia=1 and gda_grupo.RP=' . $RP;
if (!(empty($_GET))) {
  if (!(empty($_GET['asignar']))) {
    if (mysqli_multi_query($conexion, $update_limpia_guardia . "; UPDATE gda_persona SET Guardia=1 where ANI='" . $_GET["ani"] . "'")) {
      print("El ani asignado a la guardia es " . $_GET["ani"]);
    } else {
      print("Se rompió todo! -> " . $conexion->error);
    }
    mysqli_close($conexion);
  }
  if (!(empty($_GET['ruteo'])) && $_GET['ruteo'] == 1) {
    $query_asigna = "SELECT gda_persona.ANI FROM gda_persona, gda_grupo_persona, gda_grupo, gda_role
  WHERE gda_grupo_persona.IDRole = gda_role.IDRole
  AND gda_grupo_persona.IdGrupo = gda_grupo.IDGrupo
  AND gda_grupo_persona.IDPersona = gda_persona.Legajo
  AND gda_persona.Guardia = 1
  AND gda_grupo.Activo = 1
  AND gda_persona.Status= 1
  and gda_grupo.RP=" . $_GET['origen'];

    //  $query = "SELECT ANI FROM personas INNER JOIN grupos ON grupos.id = personas.id_grupo WHERE personas.Activa = 1 and grupos.dnis = ".$_GET['origen'];
    $result = mysqli_query($conexion, $query_asigna);
    while ($res = mysqli_fetch_assoc($result)) {
      print($res['ANI']);
    }
  }
} else {
  print("<html><body><form action='.' method='GET'><select name='ani'>");
  $Guardia = mysqli_query($conexion, "SELECT gda_persona.ANI, gda_persona.nombre, gda_persona.apellido, gda_persona.legajo 
  FROM gda_persona, gda_grupo_persona, gda_grupo, gda_role 
  where gda_grupo_persona.IDRole = gda_role.IDRole
  AND gda_grupo_persona.IdGrupo = gda_grupo.IDGrupo
  AND gda_grupo_persona.IDPersona = gda_persona.Legajo
  AND gda_grupo.Activo = 1
  AND gda_persona.Status= 1
  and gda_grupo.RP=" . $RP);
  while ($row = $Guardia->fetch_assoc()) {
    print($row['ANI']);
    print("<option value='" . $row['ANI'] . "'>" . $row['legajo'] . " - " . $row['nombre'] . " " . $row['apellido'] . "</option>");
  }
  print("</select>");
  print("<button type='submit'>Asignar guardia</button>");
  print("<input type='hidden' name='asignar' value='1'>");
  print("</form></body></html>");
  echo ($conexion->error);
  mysqli_close($conexion);
}
