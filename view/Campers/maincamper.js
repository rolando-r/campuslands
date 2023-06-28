(function() {
    const enlaces = document.querySelectorAll('.enlacecity');
    const contenedor = document.querySelector('#uicity');
    document.addEventListener('DOMContentLoaded', (e) => {
    });
    enlaces.forEach((val, id) => {
        val.removeEventListener('click', cargarPagina);
        val.addEventListener('click', cargarPagina);
    });
    // Función para cargar la página PHP
    function cargarPagina(e) {
        contenedor.innerHTML = '';
        var url = e.target.dataset.viewcity; // Obtiene la URL del enlace
    
        // Realiza la solicitud HTTP a la página PHP utilizando fetch
        fetch(url)
            .then(function (response) {
                if (response.ok) {
                    return response.text(); // Convierte la respuesta a texto
                }
                throw new Error('Error en la solicitud HTTP');
            })
            .then(function (data) {
    
                // Actualiza el contenido de la página actual con la respuesta de la página PHP
                let html = new DOMParser().parseFromString(data, 'text/html');
    
                let htmlCollecion = new Array(...html.head.children);
                htmlCollecion.filter((res) => {
                    let js = document.createElement('script');
    
                    if (js) {
                        // Elimina el script del <head>
                        js.remove();
    
                        // Verifica que el script se haya eliminado correctamente
                        var isScriptRemoved = !html.contains(js);
                        if (isScriptRemoved) {
                            console.log('El script se ha eliminado correctamente.');
                        } else {
                            console.log('No se pudo eliminar el script.');
                        }
                    } else {
                        console.log('El script no se encontró en el <head>.');
                    }
                    js.src = res.src;
                    js.defer = undefined;
                    document.body.appendChild(js);
                })
    
    
                contenedor.append(...html.body.children);
            })
            .catch(function (error) {
                console.log('Error: ' + error.message);
            });
    }
})();