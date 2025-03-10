CREATE TABLE tipo_persona ( 
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizacion TIMESTAMP NULL DEFAULT NULL,
    eliminacion DATETIME DEFAULT NULL,
    id_tipo_persona INT(11) NOT NULL PRIMARY KEY,
    nombre_tipo VARCHAR(50) NOT NULL UNIQUE COMMENT 'Ejemplo: Cliente, Proveedor, Empleado',
    estatus_tipo_persona TINYINT(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB;

-- Tipos personas 
-- -- 101 : Cliente
-- -- 201 : Empleado

INSERT INTO tipo_persona (creacion, actualizacion, estatus_tipo_persona, id_tipo_persona, nombre_tipo) VALUES
    (current_timestamp(), current_timestamp(), '2', 101, 'Paciente'),
    (current_timestamp(), current_timestamp(), '2', 201, 'Trabajador');

CREATE TABLE personas (
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizacion TIMESTAMP NULL DEFAULT NULL,
    eliminacion DATETIME DEFAULT NULL,
    id_persona INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_tipo_persona INT(11) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    ap_paterno VARCHAR(50) NOT NULL,
    ap_materno VARCHAR(50) NULL DEFAULT NULL,
    telefono VARCHAR(15) NULL DEFAULT NULL,
    sexo TINYINT(1) NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    imagen VARCHAR(100) DEFAULT NULL,
    FOREIGN KEY (id_tipo_persona) REFERENCES tipo_persona(id_tipo_persona) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX (id_tipo_persona)
) ENGINE=InnoDB;

INSERT INTO personas (creacion, actualizacion, nombre, ap_paterno, ap_materno, sexo, correo, id_tipo_persona) VALUES
    (current_timestamp(), current_timestamp(),  'Superadmin', 'Paterno', 'Materno', 2, 'superadmin@esnaye.com', 201),
    (current_timestamp(), current_timestamp(),  'Admin', 'Paterno', 'Materno', 2,'admin@esnaye.com', 201),
    (current_timestamp(), current_timestamp(),  'Trabajador', 'Paterno', 'Materno', 2,'trabajador@esnaye.com', 201);


CREATE TABLE roles (
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizacion TIMESTAMP NULL DEFAULT NULL,
    eliminacion DATETIME DEFAULT NULL,
    id_rol INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_rol VARCHAR(50) NOT NULL,
    estatus_rol TINYINT(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB;

-- ROLES 
-- -- 901 : SUPERADMIN
-- -- 801 : ADMIN
-- -- 701 : TRABAJADOR

INSERT INTO roles (creacion, actualizacion, estatus_rol, id_rol, nombre_rol) VALUES
    (current_timestamp(), current_timestamp(), '2', 901, 'Superadmin'),
    (current_timestamp(), current_timestamp(), '2', 801, 'Administrador'),
    (current_timestamp(), current_timestamp(), '2', 701, 'Trabajador');

CREATE TABLE usuarios (
    id_usuario INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_persona INT(11) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    estatus_usuario TINYINT(1) NOT NULL DEFAULT 2 COMMENT '2 -> Activo, 1 -> Inactivo',
    FOREIGN KEY (id_persona) REFERENCES personas(id_persona) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX (id_persona)
) ENGINE=InnoDB;

INSERT INTO usuarios (id_persona, contrasena, estatus_usuario ) VALUES
    (1, SHA2('superadmin123',0), 2),
    (2, SHA2('admin123',0), 2),
    (3, SHA2('trabajador123',0), 2);


-- Nueva tabla intermedia para asignar múltiples roles a un usuario
CREATE TABLE usuario_roles (
    id_usuario INT(11) NOT NULL,
    id_rol INT(11) NOT NULL,
    PRIMARY KEY (id_usuario, id_rol),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO usuario_roles (id_usuario, id_rol) VALUES
    (1, 901),
    (2, 801),
    (3, 701);

-- Tabla de servicios
CREATE TABLE servicios (
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizacion TIMESTAMP NULL DEFAULT NULL,
    eliminacion DATETIME DEFAULT NULL,
    id_servicio INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_servicio VARCHAR(100) NOT NULL,
    descripcion_servicio TEXT NULL DEFAULT NULL,
    precio_servicio DECIMAL(10,2) NOT NULL,
    estatus_servicio TINYINT(1) NOT NULL DEFAULT 2 COMMENT '2 -> Activo, 1 -> Inactivo'
) ENGINE=InnoDB;

INSERT INTO servicios (nombre_servicio, descripcion_servicio, precio_servicio, estatus_servicio) VALUES
('Tratamiento para Uñas Encarnadas', 'Corrección y tratamiento para uñas encarnadas, aliviando el dolor y previniendo infecciones.', 500.00, 2),
('Eliminación de Callosidades', 'Remoción segura de callos y durezas en los pies para mejorar la comodidad y salud de la piel.', 450.00, 2),
('Tratamiento de Infecciones por Hongos', 'Terapia especializada para eliminar hongos en uñas y piel del pie.', 600.00, 2),
('Cuidado y Prevención de Enfermedades del Pie', 'Evaluación y tratamiento de diversas enfermedades que afectan los pies.', 550.00, 2),
('Manejo de Hiperhidrosis (Sudoración Excesiva)', 'Tratamientos para reducir la sudoración excesiva en los pies.', 700.00, 2),
('Tratamiento de Psoriasis en los Pies', 'Terapia especializada para controlar los síntomas de la psoriasis en los pies.', 650.00, 2),
('Prevención y Cuidado de Lesiones Leves', 'Atención y prevención de pequeñas lesiones en los pies para evitar complicaciones.', 400.00, 2),
('Recuperación y Mantenimiento de la Salud Podológica', 'Sesiones de cuidado integral para mantener la salud de los pies.', 750.00, 2);

-- Tabla de categorías de productos
CREATE TABLE categorias (
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizacion TIMESTAMP NULL DEFAULT NULL,
    eliminacion DATETIME DEFAULT NULL,
    id_categoria INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL,
    descripcion_categoria TEXT NULL DEFAULT NULL,
    estatus_categoria TINYINT(1) NOT NULL DEFAULT 2 COMMENT '2 -> Activo, 1 -> Inactivo'
) ENGINE=InnoDB;

INSERT INTO categorias (nombre_categoria, descripcion_categoria, estatus_categoria) VALUES
('Cremas y Lociones', 'Productos hidratantes y reparadores para el cuidado de la piel de los pies.', 2),
('Antimicóticos', 'Productos especializados para el tratamiento de infecciones por hongos en los pies y uñas.', 2),
('Plantillas y Ortopedia', 'Plantillas, soportes y productos ortopédicos para mejorar la postura y aliviar molestias en los pies.', 2),
('Instrumental Podológico', 'Herramientas y utensilios utilizados en tratamientos podológicos.', 2),
('Calcetines y Medias Terapéuticas', 'Medias y calcetines especiales para mejorar la circulación y prevenir afecciones.', 2),
('Desodorantes y Antitranspirantes', 'Productos para controlar la sudoración y el mal olor en los pies.', 2),
('Cuidado de Uñas', 'Cortauñas, limas y otros productos para el mantenimiento saludable de las uñas.', 2),
('Protectores y Apósitos', 'Almohadillas, vendajes y protectores para evitar el roce y aliviar el dolor en los pies.', 2);


-- La tabla de citas se relaciona con personas
CREATE TABLE citas (
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizacion TIMESTAMP NULL DEFAULT NULL,
    eliminacion DATETIME DEFAULT NULL,
    id_cita INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_persona INT(11) NOT NULL,
    id_servicio INT(11) NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    estado_cita VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_persona) REFERENCES personas(id_persona) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX (id_persona),
    INDEX (id_servicio)
) ENGINE=InnoDB;

-- Tabla de productos
CREATE TABLE productos (
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizacion TIMESTAMP NULL DEFAULT NULL,
    eliminacion DATETIME DEFAULT NULL,
    id_producto INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(100) NOT NULL,
    descripcion_producto TEXT NULL DEFAULT NULL,
    cantidad_producto INT(3) NOT NULL,
    stock_minimo_producto INT(3) NOT NULL DEFAULT 0,
    estatus_producto TINYINT(1) NOT NULL DEFAULT 2 COMMENT '2 -> Activo, 1 -> Inactivo'
) ENGINE=InnoDB;

INSERT INTO productos (nombre_producto, descripcion_producto, cantidad_producto, stock_minimo_producto, estatus_producto) VALUES
('Crema Hidratante para Pies', 'Crema nutritiva con urea y aloe vera para el cuidado diario de los pies.', 50, 5, 2),
('Spray Antifúngico', 'Solución antimicótica para prevenir y tratar infecciones por hongos en pies y uñas.', 30, 5, 2),
('Plantillas Ortopédicas', 'Plantillas ergonómicas para mejorar la postura y aliviar la presión en los pies.', 20, 3, 2),
('Tijeras Podológicas', 'Tijeras de acero inoxidable diseñadas para cortar uñas gruesas y resistentes.', 15, 2, 2),
('Calcetines de Compresión', 'Medias terapéuticas para mejorar la circulación y reducir la fatiga en los pies.', 40, 10, 2),
('Polvo Antitranspirante', 'Polvo desodorante y antitranspirante para mantener los pies secos y frescos.', 25, 5, 2),
('Lima para Pies', 'Lima profesional para remover durezas y callosidades.', 35, 5, 2),
('Protectores de Juanetes', 'Separadores y protectores de silicona para aliviar el dolor de los juanetes.', 25, 5, 2),
('Venda Adhesiva para Callos', 'Apósito especial para proteger y aliviar la presión sobre los callos.', 30, 5, 2),
('Solución para Uñas Engrosadas', 'Líquido reblandecedor para el tratamiento de uñas engrosadas y difíciles de cortar.', 20, 3, 2);


CREATE TABLE producto_categoria (
    id_producto INT(11) NOT NULL,
    id_categoria INT(11) NOT NULL,
    PRIMARY KEY (id_producto, id_categoria),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE CASCADE
) ENGINE=InnoDB;


-- Tabla de relación entre citas y productos utilizados en ellas
CREATE TABLE citas_productos (
    id_citas_productos INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cita INT(11) NOT NULL,
    id_producto INT(11) NOT NULL,
    unidad INT(3) NOT NULL,
    FOREIGN KEY (id_cita) REFERENCES citas(id_cita) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX (id_cita),
    INDEX (id_producto)
) ENGINE=InnoDB;
