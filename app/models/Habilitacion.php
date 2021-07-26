<?php

/**
 * This is the model class for table "Habilitaciones".
 */
class Habilitacion
{
    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        $result = $conn->store(HABILITACIONES, $array);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al guardar un habilitacion';
            cargarLog(null, $this->id_solicitud, $error, get_class(), __FUNCTION__);
        }
        return $result;
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $habilitacion = $conn->search(HABILITACIONES, $param, $ops);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al listar las habilitaciones';
            cargarLog(null, null, $error, get_class(), __FUNCTION__);
        }
        $array = [];
        while ($row = odbc_fetch_array($habilitacion)) array_push($array, $row);
        return json_encode($array);
    }

    public static function get($params)
    {
        $conn = new BaseDatos();
        $result = $conn->search(HABILITACIONES, $params);
        $habilitacion = $conn->fetch_assoc($result);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a obtener el habilitacion: ' . $params[0];
            cargarLog(null, null, $error, get_class(), __FUNCTION__);
        }
        return json_encode($habilitacion);
    }

    public static function update($res, $id)
    {
        $conn = new BaseDatos();
        $result = $conn->update(HABILITACIONES, $res, $id);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a modificar el habilitacion ' . $id;
            cargarLog(null, null, $error, get_class(), __FUNCTION__);
        }
        return $result;
    }
}
