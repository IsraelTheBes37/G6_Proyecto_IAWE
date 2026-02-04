# G6_Proyecto_IAWE

# 🚚 SwiftPack – Agencia de Paquetería (Proyecto PHP)

## 📌 Descripción del proyecto

**SwiftPack** es una aplicación web desarrollada en **PHP** con arquitectura básica **MVC** (Modelo – Vista – Controlador), creada con fines didácticos para el módulo de **Implantación de Aplicaciones Web / Programación Web en Entorno Servidor**.

El proyecto simula el funcionamiento de una **agencia de paquetería**, permitiendo:

* Visualizar servicios y vehículos mediante **arrays en PHP**
* Autenticación de usuarios (login y registro)
* Gestión de envíos mediante **base de datos MySQL**
* Diferenciación de roles (administrador y cliente)

---

## 🧠 Objetivos didácticos

Este proyecto aplica y refuerza los siguientes conceptos:

* Enrutamiento manual con `index.php`
* Uso de **arrays simples y multidimensionales**
* Separación de lógica (modelo, vistas, helpers)
* Conexión a base de datos con **MySQLi**
* Gestión de sesiones en PHP
* Validación y saneamiento de datos
* Control de accesos por rol
* Uso de formularios HTML + PHP
* Estructuras de control (`switch`, `if`, `foreach`)
* Seguridad básica (escape HTML, validaciones, roles)

---

## 🗂️ Estructura del proyecto

```
proyecto/
│
├── css/
│   └── estilo.css
│
├── images/
│   └── Copilot_logo.png
│
├── includes/
│   ├── cabecera.php
│   └── pie.php
│
├── vistas/
│   ├── home.php
│   ├── login.php
│   ├── registro.php
│   ├── dashboard.php
│   ├── crear_envio.php
│   ├── listar_envios.php
│   ├── servicios.php
│   ├── vehiculos.php
│   └── acerca.php
│
├── herramientas/
│   └── funciones_para_arrays.php
│
├── modelos/
│   └── modelo.php
│
├── sql/
│   └── script_sql_bd.sql
│
├── index.php
└── README.md
```

---

## 🔀 Enrutamiento

El archivo `index.php` actúa como **controlador frontal** y gestiona la navegación mediante el parámetro `accion`:

Ejemplo:

```url
index.php?accion=login
index.php?accion=vehiculos
index.php?accion=listar_envios
```

El enrutamiento se controla con un `switch`, permitiendo centralizar la lógica y evitar accesos directos a las vistas.

---

## 📦 Uso de ARRAYS (Parte sin Base de Datos)

Las vistas **Servicios** y **Vehículos** trabajan con **arrays PHP**, simulando datos reales:

### ✔ Vehículos

* Array multidimensional
* Filtros por tipo
* Ordenación por kilómetros
* Cálculo de totales y disponibilidad

### ✔ Servicios

* Listado de servicios
* Zonas de envío
* Cálculo de precios estimados

Esto permite practicar:

* `foreach`
* `array_filter`
* `uasort`
* Funciones personalizadas

---

## 🗄️ Uso de BASE DE DATOS (MySQL)

El sistema gestiona mediante base de datos:

* Usuarios (admin / cliente)
* Estados de envío
* Envíos

### Funciones principales en `modelo.php`:

* `conectar_db()`
* `login_usuario()`
* `registrar_cliente()`
* `insertar_envio()`
* `obtener_envios()`
* `obtener_envios_cliente()`
* `eliminar_envio()`

---

## 👤 Roles del sistema

### 🔑 Administrador

* Ver todos los envíos
* Crear envíos
* Editar y eliminar envíos
* Ver clientes

### 👥 Cliente

* Ver únicamente sus envíos
* Acceder a su dashboard
* Consultar servicios y vehículos

---

## 🔐 Seguridad aplicada

* Uso de `session_start()`
* Protección de rutas:

  * `proteger_usuario()`
  * `proteger_admin()`
* Escape de salida HTML con `htmlspecialchars`
* Validación de formularios
* Hash de contraseñas con `SHA-256`

---

## ⚙️ Requisitos del sistema

* XAMPP / Apache
* PHP 8.x
* MySQL
* Navegador web moderno

Configuración de base de datos:

* Usuario: `root`
* Contraseña: *(vacía)*

---

## ▶️ Instalación

1. Copiar el proyecto en `htdocs`
2. Importar el archivo:

   ```
   sql/script_sql_bd.sql
   ```
3. Acceder desde el navegador:

   ```
   http://localhost/proyecto
   ```

---

## 🧪 Usuario administrador por defecto

```txt
Correo: admin@swiftpack.com
Contraseña: admin123
```

---

## 📚 Observaciones finales

Este proyecto está orientado a **exámenes prácticos**, donde:

* Se entrega código ya hecho
* Se deben corregir errores
* Optimizar lógica
* Añadir seguridad
* Implementar nuevas funcionalidades

El desarrollo prioriza la **claridad del código**, el uso de comentarios y una estructura comprensible.

