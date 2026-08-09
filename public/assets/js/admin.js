
const STORAGE_KEY = 'vocatioAdminState';
const usuarioActual = {
    usuarioId: 1,
    nombre: 'Administrador',
    tipoUsuario: 'admin'
};

const estadosBase = [
    { estadoId: 1, nombre: 'Activo' },
    { estadoId: 2, nombre: 'Inactivo' }
];

const usuariosBase = [
    {
        usuarioId: 1,
        nombre: 'Juan Carlos',
        apellidoPaterno: 'Pérez',
        apellidoMaterno: 'López',
        tipoUsuario: 'Alumno',
        estadoId: 1
    },
    {
        usuarioId: 2,
        nombre: 'María',
        apellidoPaterno: 'Solis',
        apellidoMaterno: 'Mora',
        tipoUsuario: 'Profesor',
        estadoId: 1
    }
];

const carrerasBase = [
    {
        carreraId: 1,
        nombre: 'Ingeniería en Sistemas',
        dificultad: 'Alta',
        disponibilidad: 'Disponible',
        estadoId: 1
    },
    {
        carreraId: 2,
        nombre: 'Administración',
        dificultad: 'Media',
        disponibilidad: 'Disponible',
        estadoId: 1
    }
];

let estados = [];
let usuarios = [];
let carreras = [];

function esAdmin() {
    if (usuarioActual.tipoUsuario !== 'admin') {
        throw new Error('Acceso denegado. Solo un administrador puede realizar esta acción.');
    }
}

function cargarEstadoPersistido() {
    try {
        const almacenado = localStorage.getItem(STORAGE_KEY);
        if (!almacenado) {
            return null;
        }

        const datos = JSON.parse(almacenado);
        return {
            estados: Array.isArray(datos.estados) && datos.estados.length ? datos.estados : estadosBase,
            usuarios: Array.isArray(datos.usuarios) ? datos.usuarios : [],
            carreras: Array.isArray(datos.carreras) ? datos.carreras : []
        };
    } catch (error) {
        console.warn('No fue posible cargar el estado guardado:', error);
        return null;
    }
}

function guardarEstadoPersistido() {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify({ estados, usuarios, carreras }));
    } catch (error) {
        console.warn('No fue posible guardar el estado:', error);
    }
}

function inicializarDatos() {
    const datosPersistidos = cargarEstadoPersistido();

    if (datosPersistidos) {
        estados = datosPersistidos.estados;
        usuarios = datosPersistidos.usuarios;
        carreras = datosPersistidos.carreras;
    } else {
        estados = [...estadosBase];
        usuarios = [...usuariosBase];
        carreras = [...carrerasBase];
        guardarEstadoPersistido();
    }

    if (!usuarios.length && !carreras.length) {
        usuarios = [...usuariosBase];
        carreras = [...carrerasBase];
        guardarEstadoPersistido();
    }
}

function crearEstado(nombre) {
    esAdmin();

    const estado = {
        estadoId: estados.length + 1,
        nombre
    };

    estados.push(estado);
    guardarEstadoPersistido();
    return estado;
}

function modificarEstado(id, nuevoNombre) {
    esAdmin();

    const estado = estados.find((item) => item.estadoId === id);

    if (!estado) return false;

    estado.nombre = nuevoNombre;
    guardarEstadoPersistido();
    return true;
}

function eliminarEstado(id) {
    esAdmin();

    const indice = estados.findIndex((item) => item.estadoId === id);

    if (indice === -1) return false;

    estados.splice(indice, 1);
    guardarEstadoPersistido();
    return true;
}

function crearUsuario(nombre, apellidoPaterno, apellidoMaterno, tipoUsuario, estadoId) {
    esAdmin();

    const usuario = {
        usuarioId: usuarios.length ? Math.max(...usuarios.map((item) => item.usuarioId)) + 1 : 1,
        nombre,
        apellidoPaterno,
        apellidoMaterno,
        tipoUsuario,
        estadoId: Number(estadoId)
    };

    usuarios.push(usuario);
    guardarEstadoPersistido();
    return usuario;
}

function modificarUsuario(id, datos) {
    esAdmin();

    const usuario = usuarios.find((item) => item.usuarioId === id);

    if (!usuario) return false;

    Object.assign(usuario, datos);
    guardarEstadoPersistido();
    return true;
}

function eliminarUsuario(id) {
    esAdmin();

    const indice = usuarios.findIndex((item) => item.usuarioId === id);

    if (indice === -1) return false;

    usuarios.splice(indice, 1);
    guardarEstadoPersistido();
    return true;
}

function crearCarrera(nombre, dificultad, disponibilidad, estadoId) {
    esAdmin();

    const carrera = {
        carreraId: carreras.length ? Math.max(...carreras.map((item) => item.carreraId)) + 1 : 1,
        nombre,
        dificultad,
        disponibilidad,
        estadoId: Number(estadoId)
    };

    carreras.push(carrera);
    guardarEstadoPersistido();
    return carrera;
}

function modificarCarrera(id, datos) {
    esAdmin();

    const carrera = carreras.find((item) => item.carreraId === id);

    if (!carrera) return false;

    Object.assign(carrera, datos);
    guardarEstadoPersistido();
    return true;
}

function eliminarCarrera(id) {
    esAdmin();

    const indice = carreras.findIndex((item) => item.carreraId === id);

    if (indice === -1) return false;

    carreras.splice(indice, 1);
    guardarEstadoPersistido();
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

function obtenerEstadoNombre(estadoId) {
    const estado = estados.find((item) => item.estadoId === Number(estadoId));
    return estado ? estado.nombre : 'Sin estado';
}

function obtenerEtiquetaTipoUsuario(tipoUsuario) {
    return tipoUsuario || 'Alumno';
}

function renderUsuarios() {
    const tabla = document.querySelector('#usuariosTableBody');
    if (!tabla) return;

    if (!usuarios.length) {
        tabla.innerHTML = '<tr><td colspan="5" class="text-center py-4">No hay usuarios registrados.</td></tr>';
        return;
    }

    tabla.innerHTML = usuarios.map((usuario) => `
        <tr>
            <td>
                <div class="user-cell">
                    <div class="user-avatar tertiary">${(usuario.nombre || 'U').charAt(0).toUpperCase()}</div>
                    <span class="user-name">${usuario.nombre} ${usuario.apellidoPaterno}</span>
                </div>
            </td>
            <td>
                <span class="user-email">${usuario.apellidoMaterno || '—'}</span>
            </td>
            <td>
                <span class="user-email">${obtenerEtiquetaTipoUsuario(usuario.tipoUsuario)}</span>
            </td>
            <td>
                <span class="status-badge ${Number(usuario.estadoId) === 1 ? 'status-active' : 'status-inactive'}">${obtenerEstadoNombre(usuario.estadoId)}</span>
            </td>
            <td>
                <div class="table-actions">
                    <button class="btn-icon" type="button" title="Editar" data-user-edit="${usuario.usuarioId}">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button class="btn-icon btn-delete" type="button" title="Eliminar" data-user-delete="${usuario.usuarioId}">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

function renderCarreras() {
    const tabla = document.querySelector('#carrerasTableBody');
    if (!tabla) return;

    if (!carreras.length) {
        tabla.innerHTML = '<tr><td colspan="5" class="text-center py-4">No hay carreras registradas.</td></tr>';
        return;
    }

    tabla.innerHTML = carreras.map((carrera) => `
        <tr>
            <td class="fw-semibold text-dark">${carrera.nombre}</td>
            <td>
                <span class="vt-carrera-pill vt-carrera-pill--technology">${carrera.dificultad}</span>
            </td>
            <td>
                <span class="vt-carrera-badge ${Number(carrera.estadoId) === 1 ? 'vt-carrera-badge--active' : 'vt-carrera-badge--inactive'}">${obtenerEstadoNombre(carrera.estadoId)}</span>
            </td>
            <td class="text-body-secondary">${carrera.disponibilidad}</td>
            <td>
                <div class="vt-carrera-action-buttons">
                    <button type="button" class="vt-carrera-action-btn" title="Editar" aria-label="Editar" data-carrera-edit="${carrera.carreraId}">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button type="button" class="vt-carrera-action-btn vt-carrera-action-btn--danger" title="Eliminar" aria-label="Eliminar" data-carrera-delete="${carrera.carreraId}">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

function resetearFormularioUsuario() {
    const formulario = document.querySelector('#usuarioForm');
    if (!formulario) return;

    formulario.reset();
    formulario.querySelector('[name="usuario_id"]').value = '';
    formulario.querySelector('[name="nombre"]').focus();
}

function resetearFormularioCarrera() {
    const formulario = document.querySelector('#carreraForm');
    if (!formulario) return;

    formulario.reset();
    formulario.querySelector('[name="carrera_id"]').value = '';
    formulario.querySelector('[name="nombre"]').focus();
}

function abrirFormularioUsuario(id) {
    const formulario = document.querySelector('#usuarioForm');
    const modal = document.querySelector('#usuarioModal');
    if (!formulario || !modal) return;

    const usuario = usuarios.find((item) => item.usuarioId === id);
    formulario.querySelector('[name="usuario_id"]').value = usuario ? usuario.usuarioId : '';
    formulario.querySelector('[name="nombre"]').value = usuario ? usuario.nombre : '';
    formulario.querySelector('[name="apellidoPaterno"]').value = usuario ? usuario.apellidoPaterno : '';
    formulario.querySelector('[name="apellidoMaterno"]').value = usuario ? usuario.apellidoMaterno : '';
    formulario.querySelector('[name="tipoUsuario"]').value = usuario ? usuario.tipoUsuario : 'Alumno';
    formulario.querySelector('[name="estadoId"]').value = usuario ? usuario.estadoId : 1;

    const instanciaModal = bootstrap.Modal.getOrCreateInstance(modal);
    instanciaModal.show();
}

function abrirFormularioCarrera(id) {
    const formulario = document.querySelector('#carreraForm');
    const modal = document.querySelector('#carreraModal');
    if (!formulario || !modal) return;

    const carrera = carreras.find((item) => item.carreraId === id);
    formulario.querySelector('[name="carrera_id"]').value = carrera ? carrera.carreraId : '';
    formulario.querySelector('[name="nombre"]').value = carrera ? carrera.nombre : '';
    formulario.querySelector('[name="dificultad"]').value = carrera ? carrera.dificultad : 'Media';
    formulario.querySelector('[name="disponibilidad"]').value = carrera ? carrera.disponibilidad : 'Disponible';
    formulario.querySelector('[name="estadoId"]').value = carrera ? carrera.estadoId : 1;

    const instanciaModal = bootstrap.Modal.getOrCreateInstance(modal);
    instanciaModal.show();
}

function manejarEnvioUsuario(evento) {
    evento.preventDefault();

    const formulario = evento.currentTarget;
    const usuarioId = formulario.querySelector('[name="usuario_id"]').value;
    const datos = {
        nombre: formulario.querySelector('[name="nombre"]').value.trim(),
        apellidoPaterno: formulario.querySelector('[name="apellidoPaterno"]').value.trim(),
        apellidoMaterno: formulario.querySelector('[name="apellidoMaterno"]').value.trim(),
        tipoUsuario: formulario.querySelector('[name="tipoUsuario"]').value,
        estadoId: Number(formulario.querySelector('[name="estadoId"]').value)
    };

    if (!datos.nombre) {
        alert('El nombre del usuario es obligatorio.');
        return;
    }

    if (usuarioId) {
        modificarUsuario(Number(usuarioId), datos);
    } else {
        crearUsuario(datos.nombre, datos.apellidoPaterno, datos.apellidoMaterno, datos.tipoUsuario, datos.estadoId);
    }

    renderUsuarios();
    resetearFormularioUsuario();
    bootstrap.Modal.getOrCreateInstance(document.querySelector('#usuarioModal')).hide();
}

function manejarEnvioCarrera(evento) {
    evento.preventDefault();

    const formulario = evento.currentTarget;
    const carreraId = formulario.querySelector('[name="carrera_id"]').value;
    const datos = {
        nombre: formulario.querySelector('[name="nombre"]').value.trim(),
        dificultad: formulario.querySelector('[name="dificultad"]').value,
        disponibilidad: formulario.querySelector('[name="disponibilidad"]').value,
        estadoId: Number(formulario.querySelector('[name="estadoId"]').value)
    };

    if (!datos.nombre) {
        alert('El nombre de la carrera es obligatorio.');
        return;
    }

    if (carreraId) {
        modificarCarrera(Number(carreraId), datos);
    } else {
        crearCarrera(datos.nombre, datos.dificultad, datos.disponibilidad, datos.estadoId);
    }

    renderCarreras();
    resetearFormularioCarrera();
    bootstrap.Modal.getOrCreateInstance(document.querySelector('#carreraModal')).hide();
}

function inicializarInterfaz() {
    if (typeof document === 'undefined') return;

    const formularioUsuario = document.querySelector('#usuarioForm');
    const formularioCarrera = document.querySelector('#carreraForm');
    const botonAgregarUsuario = document.querySelector('[data-open-user-modal]');
    const botonAgregarCarrera = document.querySelector('[data-open-career-modal]');

    if (formularioUsuario) {
        formularioUsuario.addEventListener('submit', manejarEnvioUsuario);
    }

    if (formularioCarrera) {
        formularioCarrera.addEventListener('submit', manejarEnvioCarrera);
    }

    if (botonAgregarUsuario) {
        botonAgregarUsuario.addEventListener('click', (evento) => {
            evento.preventDefault();
            evento.stopPropagation();
            resetearFormularioUsuario();
            abrirFormularioUsuario();
        });
    }

    if (botonAgregarCarrera) {
        botonAgregarCarrera.addEventListener('click', (evento) => {
            evento.preventDefault();
            evento.stopPropagation();
            resetearFormularioCarrera();
            abrirFormularioCarrera();
        });
    }

    document.addEventListener('click', (evento) => {
        const botonEdicionUsuario = evento.target.closest('[data-user-edit]');
        if (botonEdicionUsuario) {
            evento.preventDefault();
            abrirFormularioUsuario(Number(botonEdicionUsuario.getAttribute('data-user-edit')));
            return;
        }

        const botonEliminacionUsuario = evento.target.closest('[data-user-delete]');
        if (botonEliminacionUsuario) {
            evento.preventDefault();
            const id = Number(botonEliminacionUsuario.getAttribute('data-user-delete'));
            if (window.confirm('¿Deseas eliminar este usuario?')) {
                eliminarUsuario(id);
                renderUsuarios();
            }
            return;
        }

        const botonEdicionCarrera = evento.target.closest('[data-carrera-edit]');
        if (botonEdicionCarrera) {
            evento.preventDefault();
            abrirFormularioCarrera(Number(botonEdicionCarrera.getAttribute('data-carrera-edit')));
            return;
        }

        const botonEliminacionCarrera = evento.target.closest('[data-carrera-delete]');
        if (botonEliminacionCarrera) {
            evento.preventDefault();
            const id = Number(botonEliminacionCarrera.getAttribute('data-carrera-delete'));
            if (window.confirm('¿Deseas eliminar esta carrera?')) {
                eliminarCarrera(id);
                renderCarreras();
            }
        }
    });
}

inicializarDatos();

if (typeof document !== 'undefined') {
    document.addEventListener('DOMContentLoaded', () => {
        renderUsuarios();
        renderCarreras();
        inicializarInterfaz();
    });
}

window.adminState = {
    crearEstado,
    modificarEstado,
    eliminarEstado,
    crearUsuario,
    modificarUsuario,
    eliminarUsuario,
    crearCarrera,
    modificarCarrera,
    eliminarCarrera,
    listarEstados,
    listarUsuarios,
    listarCarreras,
    renderUsuarios,
    renderCarreras
};