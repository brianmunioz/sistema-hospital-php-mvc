<?php
require("../model/TurnosModel.php");
class TurnosController
{
    private $turnosModel;

    public function __construct()
    {
        $this->turnosModel = new TurnosModel();

    }

    public function getTurnosMedico($medicoid)
    {

        if (empty($medicoid) || !is_int($medicoid)) {
            return "tiene que ingresar su id de medico";
        } else {

            return $this->turnosModel->getTurnosMedico($medicoid);
        }


    }
    public function getTurnosPaciente($paciente)
    {

        if (empty($paciente) || !is_int($paciente)) {
            return "tiene que ingresar su id de medico";
        } else {

            return $this->turnosModel->getTurnosPaciente($paciente);
        }
    }
    public function agregarTurno($turno)
    {

        if (empty($turno["dia"])) {
            return "dia esta vacio";
        } elseif (empty($turno["hora"])) {
            return "hora esta vacio";
        } elseif (empty($turno["pacienteid"]) || !is_int($turno["pacienteid"])) {
            return "paciente id esta vacio";
        } elseif (empty($turno["medicoid"]) || !is_int($turno["medicoid"])) {
            return "medico id esta vacio";
        } else {

            $this->turnosModel->createTurno($turno);
            return "Turno creado";
        }


    }
    

}

