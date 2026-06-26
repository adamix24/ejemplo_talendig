<?php
/**
 * partes/db.php
 * -----------------------------------------------------------
 * Capa de acceso a datos sobre MongoDB (driver nativo de PHP).
 * Toda la app usa estas funciones en lugar de leer/escribir
 * archivos. La configuración vive en configx.php.
 */

require_once __DIR__ . '/../configx.php';

use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\Driver\BulkWrite;
use MongoDB\BSON\ObjectId;

/** Manager de conexión reutilizable (una sola conexión por petición). */
function db_manager() {
  static $manager = null;
  if ($manager === null) {
    $manager = new Manager(MONGODB_URI);
  }
  return $manager;
}

/** Namespace "base.coleccion" para las operaciones. */
function db_ns() {
  return MONGODB_DB . '.' . MONGODB_COLECCION;
}

/** Convierte un id (string hex) en ObjectId; null si no es válido. */
function db_oid($id) {
  try {
    return new ObjectId($id);
  } catch (\Exception $e) {
    return null;
  }
}

/** Devuelve todos los contactos ordenados por nombre. */
function contactos_todos() {
  $query  = new Query([], ['sort' => ['nombre' => 1]]);
  $cursor = db_manager()->executeQuery(db_ns(), $query);
  return $cursor->toArray(); // array de stdClass
}

/** Obtiene un contacto por su id; null si no existe / id inválido. */
function contacto_obtener($id) {
  $oid = db_oid($id);
  if ($oid === null) {
    return null;
  }
  $query  = new Query(['_id' => $oid], ['limit' => 1]);
  $cursor = db_manager()->executeQuery(db_ns(), $query);
  $docs   = $cursor->toArray();
  return $docs ? $docs[0] : null;
}

/** Inserta un contacto nuevo y devuelve su id (string hex). */
function contacto_insertar(array $datos) {
  $bulk = new BulkWrite();
  $id   = $bulk->insert($datos);
  db_manager()->executeBulkWrite(db_ns(), $bulk);
  return (string) $id;
}

/** Actualiza (campos provistos) un contacto existente. */
function contacto_actualizar($id, array $datos) {
  $oid = db_oid($id);
  if ($oid === null) {
    return;
  }
  unset($datos['_id']); // nunca se modifica el _id
  $bulk = new BulkWrite();
  $bulk->update(['_id' => $oid], ['$set' => $datos]);
  db_manager()->executeBulkWrite(db_ns(), $bulk);
}

/** Agrega una llamada al historial de un contacto. */
function contacto_agregar_llamada($id, array $llamada) {
  $oid = db_oid($id);
  if ($oid === null) {
    return;
  }
  $bulk = new BulkWrite();
  $bulk->update(['_id' => $oid], ['$push' => ['llamadas' => $llamada]]);
  db_manager()->executeBulkWrite(db_ns(), $bulk);
}

/** Elimina un contacto por su id. */
function contacto_borrar($id) {
  $oid = db_oid($id);
  if ($oid === null) {
    return;
  }
  $bulk = new BulkWrite();
  $bulk->delete(['_id' => $oid], ['limit' => 1]);
  db_manager()->executeBulkWrite(db_ns(), $bulk);
}
