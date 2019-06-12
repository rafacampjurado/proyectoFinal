<?php

class ComentariosController {

    private $lectura;
    private $escritura;

    function __construct($lectura, $escritura) {
        $this->lectura = $lectura;
        $this->escritura = $escritura;
    }

    function getLectura() {
        return $this->lectura;
    }

    function getEscritura() {
        return $this->escritura;
    }
    function getComentario ($comentario){
        return new Comentario($comentario['idOpinion'], $comentario['idUsuario'], $comentario['idProducto'], $comentario['Opinion'], $comentario['Fecha'],
                $comentario['Puntuacion'], $comentario['Aprobado']);
    }

    function actualizarAprobacionComentario($idComentario, $aprobacion){
        return $this->getEscritura()->actualizarAprobacionComentario($idComentario,$aprobacion);
    }
    function eliminarComentario($idComentario){
        return $this->getEscritura()->deleteComentarioPorId($idComentario);
    }
    public function listarComentarios() {
        $comentarios = $this->getLectura()->listadoComentarios();
        return ComentariosView::listarComentarios($comentarios);
    }

    public function adminEditarComentario($idComentario){
        $comentario = $this->getLectura()->getOpinionPorIdOpinion($idComentario)[0];
        return ComentariosView::formEditarComentario($this->getComentario($comentario));
    }
    function editarComentario($idComentario, $opinion, $fecha, $puntuacion, $aprobado){
        return $this->getEscritura()->actualizarComentario($idComentario, $opinion, $fecha, $puntuacion, $aprobado);
    }

}
