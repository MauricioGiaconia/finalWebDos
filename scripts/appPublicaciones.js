
function dibujarPublicaciones(json){

    const base = document.querySelector(".contenedor");
    var tabla;


    if (document.getElementById("publicaciones")){
        tabla = document.getElementById("publicaciones");
    } else{
        tabla = document.createElement("table");
    }

    var tbody = document.createElement("tbody");

    tabla.setAttribute("id", "publicaciones");

    if (base){

        tabla.innerHTML = "";

        var thead = document.createElement("thead");
        thead.appendChild(crearCelda("Fecha", "", false, true));
        thead.appendChild(crearCelda("Descripcion", "", false, true));
        thead.appendChild(crearCelda("Categoria", "", false, true));
        thead.appendChild(crearCelda("Usuario", "", false, true));

        tabla.appendChild(thead);

        json.forEach(element => {

            //Por cada vuelta, genero una nueva fila para insertar a la tabla
            let fila = document.createElement("tr");         
            fila.appendChild(crearCelda(element.fecha));
            fila.appendChild(crearCelda(element.descripcion));
            fila.appendChild(crearCelda(element.namecat));
            fila.appendChild(crearCelda(element.usuario));

            let btnVer = document.createElement("button");
            btnVer.appendChild(document.createTextNode("Ver"));
            btnVer.className = "ver-publicacion";
            btnVer.addEventListener("click", function () {


                verData(element.id);
            
            });

            fila.appendChild(crearCelda(btnVer, "", true));
    
            if (element.admini == 1){

                let btnEliminar = document.createElement("button");
                btnEliminar.appendChild(document.createTextNode("Desactivar"));
                btnEliminar.className = "eliminar-publicacion";
                btnEliminar.addEventListener("click", function () {

                    desactivarData(element.id);
                
                });

                fila.appendChild(crearCelda(btnEliminar, "", true));

            }
            
    
            tbody.appendChild(fila);
            

        });

        tbody.setAttribute("id", "tbody");
        tabla.appendChild(tbody);

        console.log(tabla);

        base.appendChild(tabla);

    } else{
        console.log("tabla inexistente");
    }

}

function dibujarIndividual(xpubli){

    const base = document.querySelector(".contenedor");

    base.innerHTML = "";

    var cuerpo_producto = crearDiv("producto"+xpubli.id, "cuerpo-publicacion");
    var titulo = document.createElement("h2");
    var descripcion = crearParrafo("Descripcion: " + xpubli.descripcion);
    var fecha = crearParrafo("Fecha: " + xpubli.fecha);
    var destacada = crearParrafo("Destacada: " + xpubli.destacada);
    var categoria = crearParrafo("Categoria: " + xpubli.namecat);
    var btnVolver = document.createElement("button");

    titulo.appendChild(document.createTextNode(xpubli.nombre));

    var aEtiquetas = [titulo, descripcion, fecha, categoria];

    for (let i = 0; i<aEtiquetas.length; i++){
        cuerpo_producto.appendChild(aEtiquetas[i]);
    }


    cuerpo_producto.appendChild(newSelect);
    cuerpo_producto.appendChild(crearDiv("cuerpo_comentarios", "cuerpo-comentarios"));
    getComentarios(xprod[0].id);

    btnVolver.appendChild(document.createTextNode("Volver!"));
    btnVolver.addEventListener("click", function (e){

        document.getElementById("producto"+xpubli.id).remove();
        getData(xcant*xpag-xcant, true, xactual);

    });

    cuerpo_producto.appendChild(btnVolver);

    base.appendChild(cuerpo_producto);

    

}

function crearDiv(id = "", clase = ""){
    let div = document.createElement("div");

    if (id != ""){
        div.setAttribute("id", id);
    }
    
    if (clase != ""){
        div.className = clase;
    }
    

    return div;
}

function crearCelda(contenido, clase = "", boton = false, th = false){

    let celda;
    let texto = document.createTextNode(contenido);

    if (th){
        celda = document.createElement("th");
    } else{
        celda = document.createElement("td");
    }

    if (clase != "") {
        celda.className = clase;
    }

    if (boton) {
        celda.appendChild(contenido);
    } else {
        celda.appendChild(texto);
    }


    return celda;

}

function crearParrafo(contenido, clase = ""){

    let parrafo = document.createElement("p");

    if (clase != ""){
        parrafo.className = clase;
    }

    parrafo.appendChild(document.createTextNode(contenido));

    return parrafo;

}

async function getPublicaciones(categoria = ""){
    try{

        let res = await fetch("http://localhost/webLibre/publicaciones/traerPublicaciones/" + categoria , {
                                method : 'GET',
                                body: JSON.stringify()
                            }),
            json = await res.json();


        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

        dibujarPublicaciones(json);

    } catch (err){
        console.log("Get comment: " + err);
    }


}

async function verData(xid){
    try{

        let res = await fetch("http://localhost/webLibre/publicaciones/getPublicacion"  + xid, {
                                method : 'GET',
                                body: JSON.stringify()
                            }),
            json = await res.json();


        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

        dibujarIndividual(json);

    } catch (err){
        console.log("Get comment: " + err);
    }
}

async function desactivarData(xid){
    try{

        let res = await fetch("http://localhost/webLibre/publicaciones/desactivarPublicacion"  + xid, {
                                method : 'PUT',
                           
                            });
           


        if (!res.ok) throw { status: res.status, statusText: res.statusText } //si el resultado no es ok, se tira un status con el valor mandado en status
        // y una propiedad de texto con el valor mandado en statusText

        getPublicaciones();

    } catch (err){

    }
}

getPublicaciones();