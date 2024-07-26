const express = require('express');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 8000;

// Ruta para la raíz
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'inicio', 'sesion.php'));
});

// Configuración para archivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

app.listen(PORT, () => {
  console.log(`Servidor escuchando en el puerto ${PORT}`);
});