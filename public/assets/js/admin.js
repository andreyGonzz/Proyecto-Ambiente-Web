
const usuarioActual = {
    usuarioId: 1,
    nombre: "Administrador",
    tipoUsuario: "admin"
};


function esAdmin() {
    if (usuarioActual.tipoUsuario !== "admin") {
        throw new Error("Acceso denegado. Solo un administrador puede realizar esta acción.");
    }
}

let estados = [
    {
        estadoId: 1,
        nombre: "Activo"
    },
    {
        estadoId: 2,
        nombre: "Inactivo"
    }
];

// Crear Estado
function crearEstado(nombre) {
    esAdmin();

    const estado = {
        estadoId: estados.length + 1,
        nombre
    };

    estados.push(estado);
    return estado;
}

// Modificar Estado
function modificarEstado(id, nuevoNombre) {
    esAdmin();

    const estado = estados.find(e => e.estadoId === id);

    if (!estado) return false;

    estado.nombre = nuevoNombre;
    return true;
}

// Eliminar Estado
function eliminarEstado(id) {
    esAdmin();

    const indice = estados.findIndex(e => e.estadoId === id);

    if (indice === -1) return false;

    estados.splice(indice, 1);
    return true;
}


let usuarios = [];

function crearUsuario(
    nombre,
    apellidoPaterno,
    apellidoMaterno,
    tipoUsuario,
    estadoId
) {

    esAdmin();

    const usuario = {

        usuarioId: usuarios.length + 1,
        nombre,
        apellidoPaterno,
        apellidoMaterno,
        tipoUsuario,
        estadoId

    };

    usuarios.push(usuario);

    return usuario;
}

function modificarUsuario(id, datos) {

    esAdmin();

    const usuario = usuarios.find(u => u.usuarioId === id);

    if (!usuario) return false;

    Object.assign(usuario, datos);

    return true;

}

function eliminarUsuario(id) {

    esAdmin();

    const indice = usuarios.findIndex(u => u.usuarioId === id);

    if (indice === -1) return false;

    usuarios.splice(indice, 1);

    return true;

}

let carreras = [];

function crearCarrera(

    nombre,
    dificultad,
    disponibilidad,
    estadoId

) {

    esAdmin();

    const carrera = {

        carreraId: carreras.length + 1,
        nombre,
        dificultad,
        disponibilidad,
        estadoId

    };

    carreras.push(carrera);

    return carrera;

}

function modificarCarrera(id, datos) {

    esAdmin();

    const carrera = carreras.find(c => c.carreraId === id);

    if (!carrera) return false;

    Object.assign(carrera, datos);

    return true;

}

function eliminarCarrera(id) {

    esAdmin();

    const indice = carreras.findIndex(c => c.carreraId === id);

    if (indice === -1) return false;

    carreras.splice(indice, 1);

    return true;

}


function listarEstados() {
    return estados;
}

function listarUsuarios() {
    return usuarios;
}

function listarCarreras() {
    return carreras;
}

crearUsuario(
    "Juan",
    "Perez",
    "Lopez",
    "Alumno",
    1
);

crearUsuario(
    "Maria",
    "Solis",
    "Mora",
    "Profesor",
    1
);

crearCarrera(
    "Ingeniería en Sistemas",
    "Alta",
    "Disponible",
    1
);

crearCarrera(
    "Administración",
    "Media",
    "Disponible",
    1
);

modificarUsuario(1, {
    nombre: "Juan Carlos"
});

modificarCarrera(2, {
    dificultad: "Alta"
});

console.log("ESTADOS");
console.table(listarEstados());

console.log("USUARIOS");
console.table(listarUsuarios());

console.log("CARRERAS");
console.table(listarCarreras());