<?php
require("../model/FichasModel.php");





class FichasController{

    private $fichasmodel;

    public function __construct(){
        $this->fichasmodel = new FichasModel();

    }

    public function agregarficha($ficha){
        
        if (empty($ficha["alergias"]))  {
            return "alergias esta vacio";
        }  
            elseif (empty($ficha["diagnosticos"])) {
                return "diagnosticos esta vacio";
            }
          
            elseif (empty($ficha["tratamientos"])) {
                return "tratamientos esta vacio";
            }
            elseif (empty($ficha["medicamentos"])) {
                return "medicamentos esta vacio";
            }
            elseif (empty($ficha["pacienteid"]) || !is_int($ficha["pacienteid"])) {
                return "paciente id esta vacio";
            }
        else{    
                $this->fichasmodel->createFicha($ficha);   
                return "ficha creada exitosamente";
        }
  }


  
  public function editarficha($ficha){
        
    if (empty($ficha["alergias"]))  {
        return "alergias esta vacio";
    }  
        elseif (empty($ficha["diagnosticos"])) {
            return "diagnosticos esta vacio";
        }
    
        elseif (empty($ficha["medicamentos"])) {
            return "medicamentos esta vacio";
        }
        elseif (empty($ficha["tratamientos"])) {
            return "tratamientos esta vacio";
        }
        elseif (empty($ficha["pacienteid"]) || !is_int($ficha["pacienteid"])) {
            return "paciente id esta vacio";
        }
    else{
            $this->fichasmodel->updateFicha($ficha["alergias"], $ficha["diagnosticos"], $ficha["tratamientos"],$ficha["medicamentos"], $ficha["pacienteid"],);   
            return "Ficha modificada exitosamente";
        }
}


public function eliminarficha($dni){
        
            $this->fichasmodel->deleteFicha($dni);   
            return "Ficha eliminado exitosamente";
    }

    public function obtenerficha($pacienteid){
        if( empty($pacienteid))  {
            return "ID de paciente invalido";
        } 
        else{
             return  $this->fichasmodel->getFicha($pacienteid); 
    }  
}

public function obtenerfichas(){
         return  $this->fichasmodel->getAllFichas(); 
}


}