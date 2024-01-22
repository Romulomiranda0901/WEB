-- Crear tabla de tareas
CREATE TABLE `tareas` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `completado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Procedimiento almacenado para crear una tarea
DROP PROCEDURE IF EXISTS crear_tarea;
DELIMITER &&
CREATE PROCEDURE crear_tarea(
  _nombre VARCHAR(255)
)
BEGIN
  INSERT INTO tareas(nombre, created_at, updated_at) VALUES(_nombre , NOW(), NOW());
END &&
DELIMITER ;
-- Ejemplo: CALL crear_tarea('Contestar a seguidores en el canal de youtube')

-- Procedimiento almacenado para modificar una tarea
DROP PROCEDURE IF EXISTS modificar_tarea;
DELIMITER &&
CREATE PROCEDURE modificar_tarea(
  _id bigint(20),
  _nombre VARCHAR(255)
)
BEGIN
  UPDATE tareas SET nombre = _nombre, updated_at = NOW() WHERE id = _id;
END &&
DELIMITER ;
-- Ejemplo: CALL modificar_tarea(1, 'Actualizar biografía')

-- Procedimiento almacenado para eliminar una tarea
DROP PROCEDURE IF EXISTS eliminar_tarea;
DELIMITER &&
CREATE PROCEDURE eliminar_tarea(
  _id bigint(20)
)
BEGIN
  DELETE FROM tareas WHERE id = _id;
END &&
DELIMITER ;
-- Ejemplo: CALL eliminar_tarea(1)

-- Procedimiento almacenado para completar una tarea
DROP PROCEDURE IF EXISTS completar_tarea;
DELIMITER &&
CREATE PROCEDURE completar_tarea(
  _id bigint(20)
)
BEGIN
  UPDATE tareas SET completado = TRUE, updated_at = NOW() WHERE id = _id;
END &&
DELIMITER ;
-- Ejemplo: CALL completar_tarea(1)
