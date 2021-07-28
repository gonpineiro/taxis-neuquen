<?php
class LogController
{
    /* Guarda un log */
    public function store($res)
    {
        $log = new Log();
        $log->set(...array_values($res));
        $log->save();
    }
}
