-- CREATE DATABASE ciauth;
USE bibliotecaupn24;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(30) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    
    active TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE user_roles (
    user_id INT,
    role_id INT,
    PRIMARY KEY (user_id,
role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON
DELETE
	CASCADE,
	FOREIGN KEY (role_id) REFERENCES roles(id) ON
	DELETE
		CASCADE,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON
		UPDATE
			CURRENT_TIMESTAMP,
			deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE role_permissions (
    role_id INT,
    permission_id INT,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE autores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    foto varchar(255) null,
    bio text null,
    nacionalidad varchar(100) null,
    fecha_nacimiento date null,
    fecha_fallecimiento date null,
    estado tinyint default 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE editoriales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_abreviado varchar(50) null,
    nombre VARCHAR(150) NOT NULL,
    tipo varchar(30) not null default 'editorial',
    direccion varchar(255) null,
    email varchar(100) null,
    url varchar(255) null,
    pais varchar(100) null,
    prefijos varchar(150) null,
    descripcion varchar(255) null,
    estado tinyint default 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE generos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion varchar(255) null,
    estado tinyint default 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE ubicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    estado tinyint default 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion varchar(255) null,
    estado tinyint default 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);



CREATE TABLE recursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    archivo VARCHAR(255) NULL,
    tipo VARCHAR(20) NOT NULL,
    tag int not null,
    titulo VARCHAR(255) NOT NULL,
    subtitulo VARCHAR(255) NULL,
    genero INT not NULL,
    isbn VARCHAR(20) UNIQUE,
    anio_publicacion YEAR NULL,
    idioma VARCHAR(50) NULL,
    editorial int not NULL,
    edicion VARCHAR(50) NULL,
    descripcion TEXT NULL,
    portada VARCHAR(255) NULL,
    paginas INT NULL,
    fecha_publicacion DATE NULL,
    clasificacion VARCHAR(50) NULL,
    temas TEXT NULL,
    formato VARCHAR(50) NULL,
    precio DECIMAL(10, 2) NULL,
    sellado boolean default false,
    etiquetado boolean default false,
    notas TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    index(editorial),
    FOREIGN KEY(editorial) REFERENCES editoriales(id),
    index(genero),
    FOREIGN KEY (genero) REFERENCES generos(id),
    index(tag),
    FOREIGN KEY(tag) REFERENCES tags(id)
);


CREATE TABLE ejemplares_recursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recurso INT NOT NULL,
    disponible BOOLEAN DEFAULT true,
    ubicacion INT NOT NULL,
    estado VARCHAR(50) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    index(recurso),
    FOREIGN KEY (recurso) REFERENCES recursos(id),
    index(ubicacion),
    FOREIGN KEY (ubicacion) REFERENCES ubicaciones(id)
);



CREATE TABLE reglas_prestamo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    duracion_prestamo INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE autores_recursos (
    recurso INT NOT NULL,
    autor INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (recurso, autor),
    FOREIGN KEY (recurso) REFERENCES recursos(id) ON DELETE CASCADE,
    FOREIGN KEY (autor) REFERENCES autores(id) ON DELETE CASCADE
);


CREATE TABLE prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ejemplar_recurso INT NOT NULL,
    usuario INT NOT NULL,
    regla_prestamo INT NOT NULL,
    fecha_prestamo DATE NOT NULL,
    fecha_devolucion DATETIME NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (ejemplar_recurso) REFERENCES ejemplares_recursos(id),
    FOREIGN KEY (usuario) REFERENCES users(id),
    FOREIGN KEY (regla_prestamo) REFERENCES reglas_prestamo(id)
);


CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    slug VARCHAR(255),
    descripcion TEXT,
    estado tinyint default 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME DEFAULT NULL
);


CREATE TABLE publicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    imagen VARCHAR(255),
    fecha_publicacion DATE,
    autor_id INT,
    categoria_id INT,
    slug VARCHAR(255),
    estado ENUM('publicado', 'borrador', 'archivado'),
    enlace VARCHAR(255),
    texto_enlace VARCHAR(255),
    imagen_enlace TINYTEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME DEFAULT NULL,
    FOREIGN KEY (autor_id) REFERENCES users(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);



CREATE TABLE carousel (
  id int(11) UNSIGNED NOT NULL primary key,
  filename varchar(255) NOT NULL,
  autor int(11) UNSIGNED DEFAULT NULL,
  titulo text NOT NULL,
  enlace tinytext DEFAULT NULL,
  resumen text DEFAULT NULL,
  contenido longtext DEFAULT NULL,
  estado varchar(20) NOT NULL,
  tipo varchar(20) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  deleted_at timestamp NULL DEFAULT NULL
);


INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, '2024-07-26 02:18:17', '2024-07-26 02:18:17', NULL),
(2, 'docente', NULL, '2024-07-26 02:18:17', '2024-07-26 02:18:17', NULL);

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `reset_token`, `reset_token_expires`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Edgar Degante Aguilar', 'edgar.degante.a@gmail.com', 'admin', '$2y$10$qWNc46aHhFOz9/gGp919P.Hxjn1qXXFSmF70P3relMTI5ESIOKyB.', 'b5088c1cc44ed53cab631651a003630c', '2024-07-26 15:05:37', 1, '2024-07-26 10:52:52', '2024-07-26 14:05:37', NULL);