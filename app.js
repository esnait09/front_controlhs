const express = require('express');
const path = require('path');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const { Pool } = require('pg');
require('dotenv').config();

const app = express();
const port = 4000;

// Middleware para parsear JSON
app.use(express.json());

// Middleware para configurar CORS
app.use((req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    res.header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
    if (req.method === 'OPTIONS') {
        return res.status(204).end(); // No Content
    }
    next();
});

// Servir archivos estáticos
app.use(express.static(path.join(__dirname, 'src')));

// Conexión a la base de datos
const pool = new Pool({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE, 
    port: process.env.DB_PORT,
});


// Ruta para el login
app.post('/api/login/login', async (req, res) => {
    const { username, password } = req.body;

    try {
        const query = 'SELECT * FROM users WHERE username = $1';
        const result = await pool.query(query, [username]);

        if (result.rows.length > 0) {
            const user = result.rows[0];

            const match = await bcrypt.compare(password, user.password);
            if (match) {
                const token = jwt.sign({ id: user.id, username: user.username }, process.env.JWT_SECRET, { expiresIn: '1h' });
                return res.json({ message: 'Acceso concedido', token });
            } else {
                return res.status(401).json({ message: 'Usuario o contraseña incorrectos' });
            }
        } else {
            return res.status(401).json({ message: 'Usuario o contraseña incorrectos' });
        }
    } catch (error) {
        console.error('Error al iniciar sesión:', error);
        return res.status(500).json({ message: 'Error en el servidor' });
    }
});

// Ruta para servir el index.html
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'src', 'index.html'));
});

// Ruta para manejar el envío del formulario
app.post('/api/submit', async (req, res) => {
    const { Nombre_y_Apellido, Tipo_de_proyecto, Descripcion_De_Lo_Realizado, Horas_Diarias_Realizadas } = req.body;

    try {
        
        const query = 'INSERT INTO proyectos (Nombre_y_Apellido, Tipo_de_proyecto, Descripcion_De_Lo_Realizado, Horas_Diarias_Realizadas, Fecha_Actual) VALUES ($1, $2, $3, $4, $5)';
        const values = [Nombre_y_Apellido, Tipo_de_proyecto, Descripcion_De_Lo_Realizado, Horas_Diarias_Realizadas, new Date().toISOString()];

        await pool.query(query, values);
        res.status(200).json({ message: 'Datos guardados exitosamente' });
    } catch (error) {
        console.error('Error al guardar los datos:', error);
        res.status(500).json({ message: 'Error al guardar los datos' });
    }
});

// Iniciar el servidor y verificar conexión a la base de datos
pool.connect()
    .then(() => {
        app.listen(port, () => {
            console.log(`Servidor escuchando en el puerto ${port}`);
        });
    })
    .catch(err => console.error('Error al conectar a la base de datos:', err));
