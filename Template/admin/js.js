
function habilitar(){
    let radioButton = document.querySelector('input[name="link"]:checked').value;
    let inputYoutube = document.getElementById('linkYoutube');
    let inputVimeo = document.getElementById('linkVimeo');

    if(radioButton == 'V'){
        //document.getElementById('youtube').disabled = true;
        inputYoutube.disabled = true;
        inputYoutube.value = '';
        inputVimeo.disabled = false;
    }else{
        inputYoutube.disabled = false;
        inputVimeo.disabled = true;
        inputVimeo.value = '';
    }
}

//funcion para habilitar segun el select tipo de persona
function habilitarPersona(){
    let combo = document.getElementById("tipoPersona");
    let select = combo.options[combo.selectedIndex].text;

    if(select == 'Usuario'){
        document.getElementById('tipoCurso').style.display = 'block';
        document.getElementById('labelCurso').style.display = 'block';
    }else{
        document.getElementById('tipoCurso').style.display = 'none';
        document.getElementById('labelCurso').style.display = 'none';
    }
}








