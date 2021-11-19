<?php
include_once '../../config/database.php';
if (!(empty($_GET))) {
  if (!(empty($_GET['ruteo'])) && $_GET['ruteo'] == 1) {
    $query = "SELECT gda_persona.ANI FROM gda_persona, gda_grupo_persona, gda_grupo, gda_role 
WHERE gda_grupo_persona.IDRole = gda_role.IDRole
AND gda_grupo_persona.IdGrupo = gda_grupo.IDGrupo
AND gda_grupo_persona.IDPersona = gda_persona.Legajo
AND gda_persona.Guardia = 1
AND gda_grupo.Activo = 1
AND gda_persona.Status= 1
 and gda_role.idrole in (3,2)
  and gda_grupo.RP=" .$_GET['origen'];
    $result = mysqli_query($conexion, $query);
    while ($res = mysqli_fetch_assoc($result)) {
      print($res['ANI']);
    }
  }
  if (!(empty($_GET['ani']))) {
    $query = "INSERT into gda_audit (ani,dnis) values ('" . $_GET['ani'] . "','" . $_GET['origen'] . "')";
    $result = mysqli_query($conexion, $query);
  }
} else {
  echo
    print("</body></html>");
  echo ($conexion->error);
  mysqli_close($conexion);
}
