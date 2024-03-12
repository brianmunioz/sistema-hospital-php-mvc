<?php
require("../model/UsersModel.php");





class UsersController
{

    private $usersmodel;

    public function __construct()
    {
        $this->usersmodel = new UsersModel();

    }
    
    public function login($datos)
    {
        if (empty($datos["dni"])) {
            return "
            <div class='alert alert-danger' role='alert'>
            dni esta vacio
            </div>
            ";

        } elseif (empty($datos["password"])) {
            return "
            <div class='alert alert-danger' role='alert'>
            password esta vacio
            </div>
            ";
        } else {
            $datosUsuario = $this->usersmodel->getUserbyDNI($datos["dni"]);
            if ($datosUsuario[0]["dni"] == $datos["dni"] && $datosUsuario[0]["password"] == $datos["password"]) {
                return $datosUsuario;
            } else {
                return [];
            }
        }
    }
    public function getMedicos(){
        $medicos = $this->usersmodel->getMedicos();
        return $medicos;
    }
    public function agregarusuario($user)
    {

        if (empty($user["nombre"])) {
            return "nombre esta vacio";
        } elseif (empty($user["dni"])) {
            return "dni esta vacio";
        } elseif (strlen($user["dni"]) != 8) {
            return "el numero de digitos del DNI es invalido";
        } elseif (empty($user["apellido"])) {
            return "apellido esta vacio";
        } elseif (empty($user["mail"])) {
            return "mail esta vacio";
        } elseif (empty($user["password"])) {
            return "password esta vacio";
        } else {
            $usuarioexiste = $this->usersmodel->getUserbyDNI($user["dni"]);
            if (sizeof($usuarioexiste) > 0) {
                return "el usuario ya tiene DNI en uso";
            } else {
                $this->usersmodel->createUser($user);
                return "usuario creado exitosamente";
            }
        }


    }



    public function editarusuario($user)
    {

        if (empty($user["nombre"])) {
            return "
        <div class='alert alert-danger' role='alert'>
        nombre esta vacio
        </div>";
        } elseif (empty($user["dni"])) {
            return "
            <div class='alert alert-danger' role='alert'>
            dni esta vacio
            </div>";
        } elseif (strlen($user["dni"]) != 8) {
            return "
            <div class='alert alert-danger' role='alert'>
            el numero de digitos del DNI es invalido
            </div>";
        } elseif (empty($user["apellido"])) {
            return "
            <div class='alert alert-danger' role='alert'>
            apellido esta vacio
            </div>
            ";
        } elseif (empty($user["mail"])) {
            return "
            <div class='alert alert-danger' role='alert'>
            mail esta vacio
            </div>
            ";
        } elseif (empty($user["password"])) {
            return "<div class='alert alert-danger' role='alert'>
            password esta vacio
            </div>
            ";
        } else {



            $actualizaUser = $this->usersmodel->updateUser($user);
            return $actualizaUser;


        }


    }

    public function editarpaciente($user)
    {

        if (empty($user["mail"])) {
            return "mail esta vacio";
        } elseif (empty($user["password"])) {
            return "password esta vacio";
        } else {
            
            return $this->usersmodel->updatePaciente($user["id"], $user["mail"],  $user["password"]);

        }


    }


    public function eliminarusuario($dni)
    {

        $this->usersmodel->deleteUser($dni);
        return "usuario eliminado exitosamente";
    }

    public function obtenerusuario($dni)
    {
        if (empty($dni)) {
            return " DNI  invalido";
        } else {
            return $this->usersmodel->getUserbyDNI($dni);
        }
    }

    public function obtenerusuarios()
    {
        return $this->usersmodel->getAllUsers();
    }



}

