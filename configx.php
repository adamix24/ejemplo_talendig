<?php
/**
 * configx.php
 * -----------------------------------------------------------
 * Configuración central de la conexión a la base de datos.
 * Si en el futuro cambian las credenciales, el servidor o la
 * base de datos, solo hay que editar este archivo.
 */

// Cadena de conexión a MongoDB
define('MONGODB_URI', 'mongodb://asuarez97:8096548524@mongo.ia3x.com:27017/asuarez97_finalfinal?authSource=admin');

// Base de datos y colección que usa la aplicación
define('MONGODB_DB', 'asuarez97_finalfinal');
define('MONGODB_COLECCION', 'contactos');
