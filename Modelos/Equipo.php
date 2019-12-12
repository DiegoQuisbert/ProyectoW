<?php 
require_once("../../Modelos/Conexion.php");
class Equipo {

    public function obtenerEquipos() {
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $sql = "SELECT * FROM equipos";
        foreach ($db->query($sql) as $res) {
            $equipo[] = $res;
        }
        return $equipo;
        $db->close();
    }
    
    public function ordenarEquipos($id, $orden) {
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $sql = "SELECT * FROM equipos ORDER BY {$id} {$orden}";
        foreach ($db->query($sql) as $res) {
            $equipo[] = $res;
        }
        return $equipo;
        $db->close();
    }

    public function añadirEquipo($modelodatos){
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $sql = "INSERT INTO equipos (nombre,cantidad,especificaciones,disponibilidad, encargado, contacto, categoria) VALUES('$modelodatos[nombre]','$modelodatos[cantidad]','$modelodatos[especificacion]','$modelodatos[disponibilidad]','$modelodatos[encargado]','$modelodatos[contacto]','$modelodatos[categoria]')";
        if($db->query($sql) === TRUE) {
            return 'success';
        }
        else{
            return $db->error;
        }
        $db->close();
    }

    public function filtrarEquipos($consulta){
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $q = $db->real_escape_string($consulta);
        $sql = "SELECT * FROM equipos WHERE codigo LIKE '%$q%' OR nombre LIKE '%$q%' OR cantidad LIKE '%$q%' OR especificaciones LIKE '%$q%' OR disponibilidad LIKE '%$q%' OR encargado LIKE '$q' OR contacto LIKE '$q' OR categoria LIKE '$q'";
        foreach ($db->query($sql) as $res) {
            $equipo[] = $res;
        }
        if(empty($equipo)){
            return "No hay Datos";
        }
        else{
            return $equipo;
        }
        $db->close();
    }

    public function buscarEquipos($id){
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $sql = "SELECT * FROM equipos WHERE codigo = {$id}";
        $result = $db->query($sql);
        $equipo = $result->fetch_assoc();
        return $equipo;
        $db->close();
    }

    public function editarEquipo($modelodatos){
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $sql = "UPDATE equipos SET nombre = '$modelodatos[nombre]', cantidad = '$modelodatos[cantidad]', especificaciones = '$modelodatos[especificacion]', disponibilidad = '$modelodatos[disponibilidad]', encargado = '$modelodatos[encargado]', contacto = '$modelodatos[contacto]', categoria = '$modelodatos[categoria]'WHERE codigo = $modelodatos[id]";
        if($db->query($sql) === TRUE) {
            return 'success';
        }
        else{
            return $db->error;
        }
        $db->close();
    }

    public function eliminarEquipo($id){
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $sql = "DELETE FROM equipos WHERE codigo = {$id}";
        if($db->query($sql) === TRUE) {
            return 'success';
        }
        else{
            return $db->error;
        }
        $db->close();
    }
}
?>