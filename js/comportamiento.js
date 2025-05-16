document.addEventListener("DOMContentLoaded", function () {

    switch (x) {
        case 1:
            mostrarPopup(sMsg, 1);
            break;
        default:
            console.log(x);
            break;
    }
});


function mostrarPopup(mensaje, Tipo) {
    var button = null;
    var button2 = null;
    var form = null;
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.zIndex = 1000;
    overlay.id = "popup";

    const popup = document.createElement('div');
    popup.style.background = '#fff';
    popup.style.padding = '20px';
    popup.style.borderRadius = '10px';
    popup.style.textAlign = 'center';
    popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';

    const message = document.createElement('p');

    message.textContent = mensaje;



    popup.appendChild(message);

    switch (Tipo) {
        case 1:
            button = ContentMsg();
            button.addEventListener('click', function () {
                overlay.remove();
            });
            popup.appendChild(button);
            break;
        default:
            break;



    }


    overlay.appendChild(popup);
    document.body.appendChild(overlay);

}

function ContentMsg() {
    const btn = document.createElement('button');
    btn.textContent = "Cerrar";
    return btn;
}


function evalua(sNom, sApep, sDir, Cve) {
    var sErr = "";
    var bRet = false; 
    
    
    if (sNom.disabled == false && sNom.value == "")
        sErr = sErr + "Falta nombre ";
    
    if (sApep.disabled == false && sApep.value == "")
        sErr = sErr + "Falta apellido paterno ";
    
    if (sDir.disabled == false && sDir.value == "")
        sErr = sErr + "Falta indicar direccion ";
    
    if (Cve.disabled == false && Cve.value == 0)
        sErr = sErr + "Falta asingar usuario ";
    
    if (sErr == "")
        bRet = true;
    else
        mostrarPopup(sErr, 1);

    return bRet;
}