const { Pool } = require('pg');

const pool = new Pool({
    host: 'localhost',
    user: 'postgres',
    password: 'Comp2024',
    database: 'postgres',
    port: 5432,
});

pool.connect()
    .then(() => console.log('Conexión exitosa a la base de datos.'))
    .catch(err => console.error('Error al conectar a la base de datos:', err));
