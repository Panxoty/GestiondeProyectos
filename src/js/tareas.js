(function () {
    //obtenerTareas();
    //Boton para mostrar el modal de agregar tarea
    const btnAgregarTarea = document.querySelector('#agregar-tarea');
    btnAgregarTarea.addEventListener('click', mostrarFormulario);
    //Ventana modal
    function mostrarFormulario() {
        const modal = document.createElement('div');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>Añade una nueva tarea</legend>
                <div class="campo">
                    <label>Nombre</label>
                    <input type="text" placeholder="Nombre de la tarea" name="nombre" id="nombre">
                </div>
                <div class="campo">
                    <label for="lider">Lider</label>
                    <select name="lider" id="lider">
                        <option disabled selected>-- Seleccione --</option>
                        <option value="Pedro">Pedro</option>
                        <option value="Ariel">Ariel</option>
                    </select>
                </div>
                <div class="campo">
                    <label>Especialista</label>
                    <select name="especialista" id="especialista">
                        <option disabled selected>-- Seleccione --</option>
                        <option value="Francisco"> Francisco</option>
                        <option value="David"> David</option>
                        <option value="Bastian"> Bastian</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="area">Area</label>
                    <select name="area" id="area">
                        <option disabled selected>-- Seleccione --</option>
                        <option value="backend"> Backend</option>
                        <option value="frontend"> Frontend</option>
                    </select>
                </div>
                <div class="campo">
                    <label>Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio">
                </div>
                <div class="campo">
                    <label>Fecha Termino</label>
                    <input type="date" name="fecha_fin" id="fecha_fin">
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea">
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;
        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 0);
        //Cerrar el modal cuando se presiona el boton de cancelar
        modal.addEventListener('click', (e) => { 
            e.preventDefault();
            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => { //-> Animacion de salida
                    modal.remove();
                }, 300);
            }
            if (e.target.classList.contains('submit-nueva-tarea')) {
                submitFormularioNuevaTarea();
            }
        });
        document.querySelector('.dashboard').appendChild(modal);
    }
    //Validamos datos del formulario 
    function submitFormularioNuevaTarea() {
        const nombreTarea = document.querySelector('#nombre').value.trim();
        const liderTarea = document.querySelector('#lider').value.trim();
        const especialistaTarea = document.querySelector('#especialista').value.trim();
        const areaTarea = document.querySelector('#area').value.trim();
        const fechaInicioTarea = document.querySelector('#fecha_inicio').value.trim();
        const fechaFinTarea = document.querySelector('#fecha_fin').value.trim();
        //console.log(nombreTarea);
        if (nombreTarea === '' ) {
            mostrarAlerta('El nombre de la tarea es obligatorio', 'error', document.querySelector('.formulario legend'));
            return;
        }
        else if (liderTarea === '-- Seleccione --') {
            mostrarAlerta('Debe seleccionar un lider', 'error', document.querySelector('.formulario legend'));
            return;
        }
        else if (especialistaTarea === '-- Seleccione --') {
            mostrarAlerta('Debe seleccionar un especialista', 'error', document.querySelector('.formulario legend'));
            return;
        }
        else if (areaTarea === '-- Seleccione --') {
            mostrarAlerta('Debe seleccionar un area', 'error', document.querySelector('.formulario legend'));
            return;
        }
        else if (fechaInicioTarea === '') {
            mostrarAlerta('Debe seleccionar una fecha de inicio', 'error', document.querySelector('.formulario legend'));
            return;
        }
        else if (fechaFinTarea === '') {
            mostrarAlerta('Debe seleccionar una fecha de termino', 'error', document.querySelector('.formulario legend'));
            return;
        }
        agregarTarea(nombreTarea, liderTarea, especialistaTarea, areaTarea, fechaInicioTarea, fechaFinTarea);

    }
    //Muestra la alerta en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia) {  
        //Previene la creacion de multiples alertas
        const alertaPrevia = document.querySelector('.alerta');
        if (alertaPrevia) {
            alertaPrevia.remove();
        }
        const alerta = document.createElement('div');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;
        //Inserta la alerta despues del legend
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);
        //Elimina la alerta despues de 3 segundos
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }

    //Consulta el servidor para añadir la nueva tarea
    async function agregarTarea(nombre, lider, especialista, area, fechaInicio, fechaFin) {
        //Siempre que quiera enviar datos con FORMDATA
        const datos = new FormData();
        datos.append('nombre', nombre);
        datos.append('lider', lider);
        datos.append('especialista', especialista);
        datos.append('area', area);
        datos.append('fecha_inicio', fechaInicio);
        datos.append('fecha_fin', fechaFin);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = 'http://localhost:3000/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            console.log(resultado);

            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario legend'));
            if (resultado.tipo === 'exito') { //Si la tarea se crea exitosamente se cierra el modal
                const modal = document.querySelector('.modal');
                setTimeout(() => { //-> Animacion de salida
                    modal.remove();
                    window.location.reload(); //-> Se recarga la pagina cuando se crea una tarea
                }, 1500);
            }

        } catch (error) {
            console.log(error);
        }
    }
    function obtenerProyecto() {
        //Obtenemos la url del proyecto actual
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.url;
    }

})();