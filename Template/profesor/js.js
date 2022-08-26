
function habilitar(){
    let radioButton = document.querySelector('input[name="link"]:checked').value;
    let inputYoutube = document.getElementById('linkYoutube');
    let inputVimeo = document.getElementById('linkVimeo');

    if(radioButton == 'vimeo'){
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