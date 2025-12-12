<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>CRUD Estudiantes (Interfaz)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ESTILOS BÁSICOS -->
    <style>
        :root {
            --primary: #2c7be5;
            --danger: #e03e2d;
            --muted: #6c757d;
            --card-bg: #fff;
            --page-bg: #f4f6f8;
        }
        body {
            font-family: Inter, Arial, Helvetica, sans-serif;
            background: var(--page-bg);
            margin: 0;
            padding: 20px;
        }
        .container { max-width: 1100px; margin: 0 auto; }

        header { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
        header h1 { margin:0; font-size:1.4rem; }
        header .actions { display:flex; gap:8px; }

        button.btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
        }
        button.btn.secondary {
            background: #6c757d;
        }
        button.btn.danger {
            background: var(--danger);
        }
        button.small {
            padding:6px 8px;
            font-size:0.9rem;
        }

        .card {
            background: var(--card-bg);
            padding: 14px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(20,20,20,0.05);
            margin-bottom: 14px;
        }

        /* tabla */
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #eef1f4; text-align:left; }
        th { background:#0f1724; color: #fff; font-weight:600; }
        td .actions-row { display:flex; gap:6px; }

        /* formularios */
        form.hform { display: none; gap:10px; margin-top:8px; }
        form.hform.active { display: block; }
        .form-row { display:flex; gap:8px; margin-bottom:8px; }
        .form-row .col { flex:1; }
        input[type="text"], input[type="email"], input[type="number"] {
            width:100%; padding:8px 10px; border-radius:6px; border:1px solid #d6dbe0;
            box-sizing:border-box;
        }

        .msg { margin-left:10px; color:var(--muted); font-size:0.95rem; }
        .msg.success { color: green; }
        .msg.error { color: var(--danger); }

        /* responsivo */
        @media (max-width:700px) {
            .form-row { flex-direction: column; }
            header { flex-direction:column; align-items:flex-start; gap:8px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Gestión de Estudiantes</h1>
            <div class="actions">
                <!-- Botón Insertar: muestra el formulario de creación -->
                <button id="btnToggleCreate" class="btn">➕ Insertar</button>
            </div>
        </header>

        <!-- FORMULARIO CREAR (oculto por defecto) -->
        <div class="card">
            <h3>Crear Estudiante</h3>
            <form id="formCreate" class="hform">
                <div class="form-row">
                    <div class="col">
                        <label>Nombre</label>
                        <input name="name" required>
                    </div>
                    <div class="col">
                        <label>Email</label>
                        <input name="email" type="email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label>Teléfono</label>
                        <input name="phone" type="text">
                    </div>
                    <div class="col">
                        <label>Lenguaje</label>
                        <input name="language" type="text">
                    </div>
                </div>

                <div style="margin-top:8px;">
                    <button class="btn" type="submit">Guardar</button>
                    <button id="btnCancelCreate" type="button" class="btn secondary">Cancelar</button>
                    <span id="createMsg" class="msg"></span>
                </div>
            </form>
        </div>

        <!-- FORMULARIO EDITAR COMPLETO (oculto) -->
        <div class="card">
            <h3>Editar Estudiante (Completo)</h3>
            <form id="formPut" class="hform">
                <div class="form-row">
                    <div class="col">
                        <label>ID</label>
                        <input name="id_put" type="number" readonly>
                    </div>
                    <div class="col">
                        <label>Nombre</label>
                        <input name="name_put" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label>Email</label>
                        <input name="email_put" type="email" required>
                    </div>
                    <div class="col">
                        <label>Teléfono</label>
                        <input name="phone_put" type="text">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label>Lenguaje</label>
                        <input name="language_put" type="text">
                    </div>
                </div>

                <div style="margin-top:8px;">
                    <button class="btn" type="submit">Actualizar (PUT)</button>
                    <button id="btnCancelPut" type="button" class="btn secondary">Cancelar</button>
                    <span id="putMsg" class="msg"></span>
                </div>
            </form>
        </div>

        <!-- FORMULARIO PATCH (parcial) -->
        <div class="card">
            <h3>Actualizar Parcial (PATCH)</h3>
            <form id="formPatch" class="hform">
                <div class="form-row">
                    <div class="col">
                        <label>ID</label>
                        <input name="id_patch" type="number" required>
                    </div>
                    <div class="col">
                        <label>Campo</label>
                        <select name="field_patch">
                            <option value="name">name</option>
                            <option value="email">email</option>
                            <option value="phone">phone</option>
                            <option value="language">language</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top:8px;">
                    <label>Nuevo valor</label>
                    <input name="value_patch" required>
                </div>

                <div style="margin-top:8px;">
                    <button class="btn" type="submit">Actualizar Parcial</button>
                    <button id="btnCancelPatch" type="button" class="btn secondary">Cancelar</button>
                    <span id="patchMsg" class="msg"></span>
                </div>
            </form>
        </div>

        <!-- FORMULARIO DELETE (oculto mínimo: solo id) -->
        <div class="card">
            <h3>Eliminar Estudiante</h3>
            <form id="formDelete" class="hform">
                <div class="form-row">
                    <div class="col">
                        <label>ID a eliminar</label>
                        <input name="id_delete" type="number" required>
                    </div>
                </div>
                <div style="margin-top:8px;">
                    <button class="btn danger" type="submit">Eliminar</button>
                    <button id="btnCancelDelete" type="button" class="btn secondary">Cancelar</button>
                    <span id="deleteMsg" class="msg"></span>
                </div>
            </form>
        </div>

        <!-- TABLA CON ACCIONES -->
        <div class="card">
            <h3>Listado de Estudiantes</h3>
            <div id="listArea">Cargando...</div>
        </div>

    </div> <!-- /container -->

<script>
/* ---------------------------
  Configuración y utilidades
   --------------------------- */
const API_BASE = '/api/students'; // base API

// mostrar mensaje inline
function showMsg(elId, text, type='info') {
    const el = document.getElementById(elId);
    el.className = 'msg' + (type === 'success' ? ' success' : (type === 'error' ? ' error' : ''));
    el.textContent = text;
    // desaparecer en 4s
    if (text) setTimeout(()=> { if (el.textContent === text) el.textContent = ''; }, 4000);
}

// escape simple
function esc(s) { return String(s ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

/* ---------------------------
  DOM: Mostrar / Ocultar formularios
   --------------------------- */
const formCreate = document.getElementById('formCreate');
const formPut = document.getElementById('formPut');
const formPatch = document.getElementById('formPatch');
const formDelete = document.getElementById('formDelete');

function hideAllForms() {
    formCreate.classList.remove('active');
    formPut.classList.remove('active');
    formPatch.classList.remove('active');
    formDelete.classList.remove('active');
}
function showCreate() { hideAllForms(); formCreate.classList.add('active'); }
function showPut() { hideAllForms(); formPut.classList.add('active'); }
function showPatch() { hideAllForms(); formPatch.classList.add('active'); }
function showDelete() { hideAllForms(); formDelete.classList.add('active'); }

/* Inicial: ocultar y preparar */
hideAllForms();

/* Botón Insertar (muestra u oculta Create) */
document.getElementById('btnToggleCreate').addEventListener('click', () => {
    if (formCreate.classList.contains('active')) { hideAllForms(); }
    else showCreate();
});
document.getElementById('btnCancelCreate').addEventListener('click', hideAllForms);
document.getElementById('btnCancelPut').addEventListener('click', hideAllForms);
document.getElementById('btnCancelPatch').addEventListener('click', hideAllForms);
document.getElementById('btnCancelDelete').addEventListener('click', hideAllForms);

/* ---------------------------
  FUNCIONES DE DATA (fetch y render)
   --------------------------- */

// cargar listado y renderizar
async function loadList() {
    const area = document.getElementById('listArea');
    area.innerHTML = 'Cargando...';
    try {
        const res = await fetch(API_BASE);
        if(!res.ok) throw new Error('Error ' + res.status);
        const data = await res.json();
        renderTable(data);
    } catch (err) {
        area.innerHTML = '<span style="color:red;">' + esc(err.message) + '</span>';
    }
}

function renderTable(data) {
    const area = document.getElementById('listArea');
    if (!Array.isArray(data) || data.length === 0) {
        area.innerHTML = '<p>No hay estudiantes</p>';
        return;
    }
    let html = '<table><thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Phone</th><th>Language</th><th>Acciones</th></tr></thead><tbody>';
    data.forEach(s => {
        html += `<tr>
            <td>${esc(s.id)}</td>
            <td>${esc(s.name)}</td>
            <td>${esc(s.email)}</td>
            <td>${esc(s.phone ?? '')}</td>
            <td>${esc(s.language ?? '')}</td>
            <td class="actions-row">
                <button class="small" onclick="onEdit(${s.id})">Editar</button>
                <button class="small" onclick="onPartial(${s.id})">Editar parcial</button>
                <button class="small" onclick="onDelete(${s.id})">Eliminar</button>
            </td>
        </tr>`;
    });
    html += '</tbody></table>';
    area.innerHTML = html;
}

/* ---------------------------
  HANDLERS para acciones (botones en tabla)
   --------------------------- */

// cuando el usuario clickea Editar (llenar PUT y mostrar form)
async function onEdit(id) {
    try {
        const res = await fetch(`${API_BASE}/${id}`);
        if(!res.ok) { alert('Registro no encontrado'); return; }
        const s = await res.json();
        document.querySelector('input[name="id_put"]').value = s.id;
        document.querySelector('input[name="name_put"]').value = s.name ?? '';
        document.querySelector('input[name="email_put"]').value = s.email ?? '';
        document.querySelector('input[name="phone_put"]').value = s.phone ?? '';
        document.querySelector('input[name="language_put"]').value = s.language ?? '';
        showPut();
    } catch (err) {
        alert(err.message);
    }
}

// cuando el usuario clickea Editar parcial -> llenar id en formPatch y mostrar
function onPartial(id) {
    document.querySelector('input[name="id_patch"]').value = id;
    document.querySelector('input[name="value_patch"]').value = '';
    showPatch();
}

// cuando el usuario clickea Eliminar -> llenar id en formDelete y mostrar
function onDelete(id) {
    document.querySelector('input[name="id_delete"]').value = id;
    showDelete();
}

/* ---------------------------
  SUBMIT handlers: POST / PUT / PATCH / DELETE
   --------------------------- */

// POST: crear
formCreate.addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = Object.fromEntries(new FormData(formCreate).entries());
    try {
        const res = await fetch(API_BASE, {
            method: 'POST',
            headers: {'Content-Type':'application/json','Accept':'application/json'},
            body: JSON.stringify(data)
        });
        const body = await res.json();
        if (res.status >= 200 && res.status < 300) {
            showMsg('createMsg', 'Creado correctamente', 'success');
            // Actualizar DOM: insertar nuevo registro en la tabla sin recargar lista completa
            // Para simplicidad, recargamos la lista desde backend (rápida)
            await loadList();
            hideAllForms();
            formCreate.reset();
        } else {
            showMsg('createMsg', (body.message || JSON.stringify(body)), 'error');
        }
    } catch (err) {
        showMsg('createMsg', err.message, 'error');
    }
});

// PUT: actualizar completo
formPut.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = e.target.id_put.value;
    const payload = {
        name: e.target.name_put.value,
        email: e.target.email_put.value,
        phone: e.target.phone_put.value,
        language: e.target.language_put.value
    };
    try {
        const res = await fetch(`${API_BASE}/${id}`, {
            method: 'PUT',
            headers: {'Content-Type':'application/json','Accept':'application/json'},
            body: JSON.stringify(payload)
        });
        const body = await res.json();
        if (res.status >= 200 && res.status < 300) {
            showMsg('putMsg', 'Actualizado correctamente', 'success');
            await loadList();
            hideAllForms();
        } else {
            showMsg('putMsg', (body.message || JSON.stringify(body)), 'error');
        }
    } catch (err) {
        showMsg('putMsg', err.message, 'error');
    }
});

// PATCH: actualización parcial
formPatch.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = e.target.id_patch.value;
    const field = e.target.field_patch.value;
    const value = e.target.value_patch.value;
    const payload = { [field]: value };
    try {
        const res = await fetch(`${API_BASE}/${id}`, {
            method: 'PATCH',
            headers: {'Content-Type':'application/json','Accept':'application/json'},
            body: JSON.stringify(payload)
        });
        const body = await res.json();
        if (res.status >= 200 && res.status < 300) {
            showMsg('patchMsg', 'Actualización parcial correcta', 'success');
            await loadList();
            hideAllForms();
        } else {
            showMsg('patchMsg', (body.message || JSON.stringify(body)), 'error');
        }
    } catch (err) {
        showMsg('patchMsg', err.message, 'error');
    }
});

// DELETE
formDelete.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = e.target.id_delete.value;
    try {
        const res = await fetch(`${API_BASE}/${id}`, {
            method: 'DELETE',
            headers: {'Accept':'application/json'}
        });
        let body = {};
        if (res.status !== 204) {
            body = await res.json();
        }
        if (res.status >= 200 && res.status < 300) {
            showMsg('deleteMsg', 'Eliminado correctamente', 'success');
            await loadList();
            hideAllForms();
        } else {
            showMsg('deleteMsg', (body.message || JSON.stringify(body)), 'error');
        }
    } catch (err) {
        showMsg('deleteMsg', err.message, 'error');
    }
});

/* ---------------------------
  Inicializar
   --------------------------- */
loadList();
</script>
</body>
</html>
