<?php

/**
 * This is the model class for table "Solicitud".
 *
 * @property int $id_usuario
 * @property int $id_usuario_admin
 * @property int $id_estado
 * @property int $nro_recibo
 * @property string $path_ap
 * @property string $path_recibo
 * @property string $profesion
 * @property string $profesion
 * @property string $observaciones
 * @property string $deleted_at
 * @property string $fecha_vencimiento
 * @property string $fecha_evaluacion
 * 
 */
class Solicitud
{
    public $id_usuario;
    public $id_usuario_admin;
    public $id_estado;
    public $nro_recibo;
    public $path_ap;
    public $path_recibo;
    public $observaciones;
    public $modified_at;
    public $deleted_at;
    public $fecha_vencimiento;
    public $fecha_evaluacion;

    public function __construct()
    {
        $this->id_usuario = "";
        $this->id_usuario_admin = "";
        $this->id_estado = "";
        $this->nro_recibo = "";
        $this->path_ap = "";
        $this->path_recibo = "";
        $this->observaciones = "";
        $this->modified_at = "";
        $this->deleted_at = "";
        $this->fecha_vencimiento = "";
        $this->fecha_evaluacion = "";
    }

    public function set($id_usuario = null, $id_usuario_admin = null, $id_estado = null, $nro_recibo = null, $path_ap = null, $path_recibo = null, $observaciones = null, $modified_at = null, $deleted_at = null, $fecha_vencimiento = null, $fecha_evaluacion = null)
    {
        $this->id_usuario = $id_usuario;
        $this->id_usuario_admin = $id_usuario_admin;
        $this->id_estado = $id_estado;
        $this->nro_recibo = $nro_recibo;
        $this->path_ap = $path_ap;
        $this->path_recibo = $path_recibo;
        $this->observaciones = $observaciones;
        $this->modified_at = $modified_at;
        $this->deleted_at = $deleted_at;
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->fecha_evaluacion = $fecha_evaluacion;
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        $result = $conn->store(SOLICITUDES, $array);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al guardar una solicitud';
            cargarLog($this->id_usuario, null, $error, get_class(), __FUNCTION__);
        }
        return $result;
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $solicitud = $conn->search(SOLICITUDES, $param, $ops);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al listar las solicitudes';
            cargarLog(null, null, $error, get_class(), __FUNCTION__);
        }
        return $solicitud;
    }

    public static function get($params)
    {
        $conn = new BaseDatos();
        $result = $conn->search(SOLICITUDES, $params);
        $solicitud = $conn->fetch_assoc($result);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a obtener la solicitud: ' . $params[0];
            cargarLog(null, null, $error, get_class(), __FUNCTION__);
        }
        return $solicitud;
    }

    public static function update($res, $id)
    {
        $conn = new BaseDatos();
        $result = $conn->update(SOLICITUDES, $res, $id);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a modificar la solicitud ' . $id;
            cargarLog(null, $id, $error, get_class(), __FUNCTION__);
        }
        return $result;
    }
}
