(function() {
    let myHeader = new Headers({ "Content-Type": "application/json; charset:utf8" });
    const myform = document.querySelector("#frmRegCamper");
    var row;
    let idCamperBorrar;
    $('#misPaises').DataTable().destroy();
    $('#misPaises').DataTable(  {
        pageLength: 4,
    }
    );
    $(document).ready(function() {
        var tabla = $('#misPaises').DataTable();
        // Evento click en los botones dentro de la tabla
        $('#misPaises tbody').on('click', '.btn-abrir-modal', function() {
            row = tabla.row($(this).parents('tr'));
            var fila = tabla.row($(this).closest('tr')).data();
            idCamperBorrar = fila[0]; // Obtener el valor de la columna 'Nombre'

            // Abrir el modal y mostrar el nombre del usuario
            abrirModal(fila[0], fila[1]);
        });
        $('#misPaises tbody').on('click', '.btn-editar-modal', function() {
            const frm = document.querySelector('#frmUpdateData');
            const inputsData = new FormData(frm);
            row = tabla.row($(this).parents('tr'));
            var fila = tabla.row($(this).closest('tr')).data();
            idCamperBorrar = fila[0]; // Obtener el valor de la columna 'Nombre'
            inputsData.set("idPais",fila[0]);
            inputsData.set("nombrePais",fila[1]);
            document.querySelector('.badge').innerHTML = fila[0];
            // Itera a través de los pares clave-valor de los datos
            for (var pair of inputsData.entries()) {
                // Establece los valores correspondientes en el formulario
                frm.elements[pair[0]].value = pair[1];
            }
            $('#updateData').modal('show');
            // Abrir el modal y mostrar el nombre del usuario
        });
    });
    if(myform){
        console.log(myform);
        myform.addEventListener("submit", (e) => {
            e.preventDefault();
            let data = Object.fromEntries(new FormData(e.target));
            postData(data).then(r => {
                console.log(r);
            });
        });
    }
    const postData = async (data) => {
        let config = {
            method: "POST",
            headers: myHeader,
            body: JSON.stringify(data)
        };
        let res = await (await fetch("controllers/Region/insert_data.php", config)).json();
        return res;
    }
    function editarData(){
        const frm = document.querySelector('#frmUpdateData');
        const info = Object.fromEntries(new FormData(frm));
        console.log(info);
    }
    function abrirModal(idpk, info) {
        $('#verifdel').modal('show');
        document.querySelector('#info').innerHTML = 'Desea eliminar a: <b>' + info + '</b> con Id' + idpk;
    }

    function borrarDataDb() {
        fetch('controllers/Region/delete_data.php?id=' + idCamperBorrar, {
                method: 'DELETE'
            })
            .then(response => {
                row.remove().draw();
            })
            .catch(error => {
                console.log('Error en la petición DELETE:', error);
            });

    }
})();