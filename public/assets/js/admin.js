const API_ROOT = window.API_ROOT;

let usuarios = [];
let carreras = [];
let cargaUsuariosFallida = false;
let cargaCarrerasFallida = false;

function apiUrl(controlador, accion, id) {
    let url = API_ROOT + '?url=' + controlador + '/' + accion;
    if (id !== undefined && id !== null && id !== '') {
        url += '/' + encodeURIComponent(id);
    }
    return url;
}

async function peticionApi(url, metodo = 'GET', cuerpo = null) {
    const opciones = { method: metodo };
    if (cuerpo) {
        opciones.headers = { 'Content-Type': 'application/json' };
        opciones.body = JSON.stringify(cuerpo);
    }

    let respuesta;
    try {
        respuesta = await fetch(url, opciones);
    } catch (error) {
        return { ok: false, estado: 0, datos: { message: 'No se pudo conectar con el servidor.' } };
    }

    let datos = null;
    try {
        datos = await respuesta.json();
    } catch (error) {
        datos = null;
    }

    return { ok: respuesta.ok, estado: respuesta.status, datos };
}

function escapar(texto) {
    return String(texto ?? '').replace(/[&<>"']/g, (caracter) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
    })[caracter]);
}

function validarCorreo(correo) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo);
}

function notificarExito(mensaje) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'success',
            title: mensaje,
            toast: true,
            position: 'top-end',
            timer: 2500,
            timerProgressBar: true,
            showConfirmButton: false,
        });
    } else {
        alert(mensaje);
    }
}

function notificarError(mensaje) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
    } else {
        alert(mensaje);
    }
}

function notificarAdvertencia(mensaje) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({ icon: 'warning', title: mensaje });
    } else {
        alert(mensaje);
    }
}

async function cargarUsuarios() {
    const resultado = await peticionApi(apiUrl('usuario', 'apiList'));
    cargaUsuariosFallida = !resultado.ok;

    if (resultado.ok && Array.isArray(resultado.datos)) {
        usuarios = resultado.datos.map((usuario) => ({
            usuarioId: Number(usuario.id),
            nombre: usuario.nombre || '',
            correo: usuario.correo || '',
            rol: usuario.rol || 'USUARIO',
        }));
    } else {
        usuarios = [];
    }

    renderUsuarios();
}

async function cargarCarreras() {
    const resultado = await peticionApi(apiUrl('carrera', 'apiList'));
    cargaCarrerasFallida = !resultado.ok;

    if (resultado.ok && Array.isArray(resultado.datos)) {
        carreras = resultado.datos.map((carrera) => ({
            ...carrera,
            carreraId: Number(carrera.carreraId),
            estadoId: Number(carrera.estadoId),
        }));
    } else {
        carreras = [];
    }

    renderCarreras();
}

async function crearUsuario(datos) {
    const resultado = await peticionApi(apiUrl('usuario', 'apiStore'), 'POST', {
        name: datos.nombre,
        email: datos.correo,
        password: datos.contrasena,
        rol: datos.rol,
    });

    if (!resultado.ok) {
        notificarError(resultado.datos?.message || 'Error al crear el usuario.');
        return false;
    }

    return true;
}

async function modificarUsuario(usuarioId, datos) {
    const resultado = await peticionApi(apiUrl('usuario', 'apiUpdate', usuarioId), 'POST', {
        name: datos.nombre,
        email: datos.correo,
    });

    if (!resultado.ok) {
        notificarError(resultado.datos?.message || 'Error al actualizar el usuario.');
        return false;
    }

    return true;
}

async function eliminarUsuario(usuarioId) {
    const resultado = await peticionApi(apiUrl('usuario', 'apiDelete', usuarioId), 'POST');

    if (!resultado.ok) {
        notificarError(resultado.datos?.message || 'Error al eliminar el usuario.');
        return false;
    }

    return true;
}

async function crearCarrera(datos) {
    const resultado = await peticionApi(apiUrl('carrera', 'apiStore'), 'POST', datos);

    if (!resultado.ok) {
        notificarError(resultado.datos?.message || 'Error al crear la carrera.');
        return false;
    }

    return true;
}

async function modificarCarrera(carreraId, datos) {
    const resultado = await peticionApi(apiUrl('carrera', 'apiUpdate', carreraId), 'POST', datos);

    if (!resultado.ok) {
        notificarError(resultado.datos?.message || 'Error al actualizar la carrera.');
        return false;
    }

    return true;
}

async function eliminarCarrera(carreraId) {
    const resultado = await peticionApi(apiUrl('carrera', 'apiDelete', carreraId), 'POST');

    if (!resultado.ok) {
        notificarError(resultado.datos?.message || 'Error al eliminar la carrera.');
        return false;
    }

    return true;
}

function renderUsuarios(lista = usuarios) {
    const tabla = document.querySelector('#usuariosTableBody');
    if (!tabla) return;

    if (!lista.length) {
        tabla.innerHTML = cargaUsuariosFallida
            ? '<tr><td colspan="4" class="text-center py-4">No se pudieron cargar los datos.</td></tr>'
            : '<tr><td colspan="4" class="text-center py-4">No hay usuarios registrados.</td></tr>';
        return;
    }

    tabla.innerHTML = lista.map((usuario) => `
        <tr>
            <td>
                <div class="user-cell">
                    <div class="user-avatar tertiary">${(usuario.nombre || 'U').charAt(0).toUpperCase()}</div>
                    <span class="user-name">${escapar(usuario.nombre)}</span>
                </div>
            </td>
            <td>
                <span class="user-email">${escapar(usuario.correo)}</span>
            </td>
            <td>
                <span class="status-badge ${usuario.rol === 'ADMIN' ? 'status-active' : 'status-inactive'}">${escapar(usuario.rol)}</span>
            </td>
            <td class="text-right">
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

function renderCarreras(lista = carreras) {
    const tabla = document.querySelector('#carrerasTableBody');
    if (!tabla) return;

    if (!lista.length) {
        tabla.innerHTML = cargaCarrerasFallida
            ? '<tr><td colspan="6" class="text-center py-4">No se pudieron cargar los datos.</td></tr>'
            : '<tr><td colspan="6" class="text-center py-4">No hay carreras registradas.</td></tr>';
        return;
    }

    tabla.innerHTML = lista.map((carrera) => {
        const miniatura = carrera.imagen
            ? `<img src="${escapar(carrera.imagen)}" alt="${escapar(carrera.nombre)}" class="vt-carrera-thumb" onerror="this.style.display='none'">`
            : '<span class="vt-carrera-thumb-placeholder material-symbols-outlined">work</span>';

        const estadoActivo = Number(carrera.estadoId) === 1;

        return `
        <tr>
            <td>${miniatura}</td>
            <td class="fw-semibold text-dark">${escapar(carrera.nombre)}</td>
            <td>
                <span class="vt-carrera-pill vt-carrera-pill--technology">${escapar(carrera.dificultad)}</span>
            </td>
            <td>
                <span class="vt-carrera-badge ${estadoActivo ? 'vt-carrera-badge--active' : 'vt-carrera-badge--inactive'}">${estadoActivo ? 'Activo' : 'Inactivo'}</span>
            </td>
            <td class="text-body-secondary">${escapar(carrera.disponibilidad)}</td>
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
        </tr>`;
    }).join('');
}

function resetearFormularioUsuario() {
    const formulario = document.querySelector('#usuarioForm');
    if (!formulario) return;

    formulario.reset();
    formulario.querySelector('[name="usuario_id"]').value = '';
    mostrarCampoContrasena(true);
    mostrarCampoRol(true);
    formulario.querySelector('[name="nombre"]').focus();
}

function mostrarCampoContrasena(visible) {
    const campo = document.querySelector('#campoContrasena');
    if (campo) {
        campo.classList.toggle('d-none', !visible);
    }
}

function mostrarCampoRol(visible) {
    const campo = document.querySelector('#campoRol');
    if (campo) {
        campo.classList.toggle('d-none', !visible);
    }
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

    const usuario = usuarios.find((item) => item.usuarioId === Number(id));
    formulario.querySelector('[name="usuario_id"]').value = usuario ? usuario.usuarioId : '';
    formulario.querySelector('[name="nombre"]').value = usuario ? usuario.nombre : '';
    formulario.querySelector('[name="correo"]').value = usuario ? usuario.correo : '';
    formulario.querySelector('[name="contrasena"]').value = '';
    mostrarCampoContrasena(!usuario);
    mostrarCampoRol(!usuario);

    bootstrap.Modal.getOrCreateInstance(modal).show();
}

function abrirFormularioCarrera(id) {
    const formulario = document.querySelector('#carreraForm');
    const modal = document.querySelector('#carreraModal');
    if (!formulario || !modal) return;

    const carrera = carreras.find((item) => item.carreraId === Number(id));
    formulario.querySelector('[name="carrera_id"]').value = carrera ? carrera.carreraId : '';
    formulario.querySelector('[name="nombre"]').value = carrera ? carrera.nombre : '';
    formulario.querySelector('[name="imagen"]').value = carrera ? (carrera.imagen || '') : '';
    formulario.querySelector('[name="dificultad"]').value = carrera ? carrera.dificultad : 'Media';
    formulario.querySelector('[name="disponibilidad"]').value = carrera ? carrera.disponibilidad : 'Disponible';
    formulario.querySelector('[name="estadoId"]').value = carrera ? carrera.estadoId : 1;

    bootstrap.Modal.getOrCreateInstance(modal).show();
}

async function manejarEnvioUsuario(evento) {
    evento.preventDefault();

    const formulario = evento.currentTarget;
    const usuarioId = formulario.querySelector('[name="usuario_id"]').value;
    const datos = {
        nombre: formulario.querySelector('[name="nombre"]').value.trim(),
        correo: formulario.querySelector('[name="correo"]').value.trim(),
        contrasena: formulario.querySelector('[name="contrasena"]').value,
        rol: formulario.querySelector('[name="rol"]').value,
    };

    if (!datos.nombre) {
        notificarAdvertencia('El nombre del usuario es obligatorio.');
        return;
    }

    if (!validarCorreo(datos.correo)) {
        notificarAdvertencia('Ingresa un correo electrónico válido.');
        return;
    }

    if (!usuarioId && !datos.contrasena) {
        notificarAdvertencia('La contraseña es obligatoria al crear un usuario.');
        return;
    }

    const boton = formulario.querySelector('button[type="submit"]');
    boton.disabled = true;

    let exito = false;
    if (usuarioId) {
        exito = await modificarUsuario(Number(usuarioId), datos);
    } else {
        exito = await crearUsuario(datos);
    }

    boton.disabled = false;
    if (!exito) return;

    notificarExito(usuarioId ? 'Usuario actualizado correctamente' : 'Usuario creado correctamente');
    bootstrap.Modal.getOrCreateInstance(document.querySelector('#usuarioModal')).hide();
    resetearFormularioUsuario();
    await cargarUsuarios();
}

async function manejarEnvioCarrera(evento) {
    evento.preventDefault();

    const formulario = evento.currentTarget;
    const carreraId = formulario.querySelector('[name="carrera_id"]').value;
    const datos = {
        nombre: formulario.querySelector('[name="nombre"]').value.trim(),
        imagen: formulario.querySelector('[name="imagen"]').value.trim(),
        dificultad: formulario.querySelector('[name="dificultad"]').value,
        disponibilidad: formulario.querySelector('[name="disponibilidad"]').value,
        estadoId: Number(formulario.querySelector('[name="estadoId"]').value),
    };

    if (!datos.nombre) {
        notificarAdvertencia('El nombre de la carrera es obligatorio.');
        return;
    }

    const boton = formulario.querySelector('button[type="submit"]');
    boton.disabled = true;

    let exito = false;
    if (carreraId) {
        exito = await modificarCarrera(Number(carreraId), datos);
    } else {
        exito = await crearCarrera(datos);
    }

    boton.disabled = false;
    if (!exito) return;

    notificarExito(carreraId ? 'Carrera actualizada correctamente' : 'Carrera creada correctamente');
    bootstrap.Modal.getOrCreateInstance(document.querySelector('#carreraModal')).hide();
    resetearFormularioCarrera();
    await cargarCarreras();
}

function configurarBusqueda() {
    const inputUsuarios = document.querySelector('#usuarioBusqueda');
    if (inputUsuarios) {
        inputUsuarios.addEventListener('input', () => {
            const termino = inputUsuarios.value.trim().toLowerCase();
            if (!termino) {
                renderUsuarios();
                return;
            }
            const filtrados = usuarios.filter((usuario) =>
                usuario.nombre.toLowerCase().includes(termino)
                || usuario.correo.toLowerCase().includes(termino)
                || usuario.rol.toLowerCase().includes(termino)
            );
            renderUsuarios(filtrados);
        });
    }

    const inputCarreras = document.querySelector('#carreraBusqueda');
    if (inputCarreras) {
        inputCarreras.addEventListener('input', () => {
            const termino = inputCarreras.value.trim().toLowerCase();
            if (!termino) {
                renderCarreras();
                return;
            }
            const filtrados = carreras.filter((carrera) =>
                carrera.nombre.toLowerCase().includes(termino)
                || (carrera.dificultad || '').toLowerCase().includes(termino)
            );
            renderCarreras(filtrados);
        });
    }
}

function inicializarInterfaz() {
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

    configurarBusqueda();

    document.addEventListener('click', async (evento) => {
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
                const eliminado = await eliminarUsuario(id);
                if (eliminado) {
                    notificarExito('Usuario eliminado correctamente');
                    await cargarUsuarios();
                }
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
                const eliminado = await eliminarCarrera(id);
                if (eliminado) {
                    notificarExito('Carrera eliminada correctamente');
                    await cargarCarreras();
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', async () => {
    inicializarInterfaz();
    await cargarUsuarios();
    await cargarCarreras();
});

window.adminState = {
    cargarUsuarios,
    cargarCarreras,
    crearUsuario,
    modificarUsuario,
    eliminarUsuario,
    crearCarrera,
    modificarCarrera,
    eliminarCarrera,
    renderUsuarios,
    renderCarreras,
};