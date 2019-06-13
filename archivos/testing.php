<?php
require 'acciones/Conexion.php';
require 'acciones/Lectura.php';
require 'acciones/Escritura.php';
require 'funciones/funciones.php';
require 'controlador/userController.php';
$conexion = new Conexion();
$lectura = new Lectura($conexion);
$escritura = new Escritura($conexion);
session_start();
var_dump($_SESSION);