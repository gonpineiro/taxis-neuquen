<?php

/**
 * This is the model class for table "Choferes".
 */
class Chofer
{
    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new BaseDatos();
        $result = $conn->store(CHOFERES, $array);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al guardar un chofer';
            cargarLog(null, $this->id_solicitud, $error, get_class(), __FUNCTION__);
        }
        return $result;
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new BaseDatos();
        $chofer = $conn->search(CHOFERES, $param, $ops);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error al listar las habilitaciones';
            cargarLog(null, null, $error, get_class(), __FUNCTION__);
        }
        $array = [];
        while ($row = odbc_fetch_array($chofer)) array_push($array, $row);
        return json_encode($array);
    }

    public static function get($params)
    {
        $conn = new BaseDatos();
        $result = $conn->search(CHOFERES, $params);
        $chofer = $conn->fetch_assoc($result);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a obtener el chofer: ' . $params[0];
            cargarLog(null, null, $error, get_class(), __FUNCTION__);
        }
        return $chofer;
    }

    public static function update($res, $id)
    {
        $conn = new BaseDatos();
        $result = $conn->update(CHOFERES, $res, $id);

        /* Guardamos los errores */
        if ($conn->getError()) {
            $error =  $conn->getError() . ' | Error a modificar el chofer ' . $id;
            cargarLog(null, null, $error, get_class(), __FUNCTION__);
        }
        return $result;
    }
}
