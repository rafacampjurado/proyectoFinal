<?php

class Comentario {

    private $idOpinion;
    private $idUsuario;
    private $idProducto;
    private $opinion;
    private $fecha;
    private $puntuacion;
    private $aprobado;

    function __construct($idOpinion, $idUsuario, $idProducto, $opinion, $fecha, $puntuacion, $aprobado) {
        $this->idOpinion = $idOpinion;
        $this->idUsuario = $idUsuario;
        $this->idProducto = $idProducto;
        $this->opinion = $opinion;
        $this->fecha = $fecha;
        $this->puntuacion = $puntuacion;
        $this->aprobado = $aprobado;
    }

    function getIdOpinion() {
        return $this->idOpinion;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getOpinion() {
        return $this->opinion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getPuntuacion() {
        return $this->puntuacion;
    }

    function getAprobado() {
        return $this->aprobado;
    }

}
