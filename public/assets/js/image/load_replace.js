$('document').ready(function () {
    $('#tcover').change((e) => {
        let reader = new FileReader();
        reader.onload = function (event) {
            // Aqui você pode acessar o resultado da leitura da imagem em event.target.result
            let imageDataURL = event.target.result;
            // Faça algo com a imagemDataURL, como exibir a imagem
            //$('#preview').attr('src', imageDataURL);
            var img_container = e.target.nextElementSibling;
            img_container.classList.length < 2 ? img_container.classList.add('active') : '';
            var img = e.target.nextElementSibling.querySelector('img');
            img.src = '';
            img.src = imageDataURL
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    $('#tassetI').change((e) => {
        count(e.target.files.length, e, 'Imagens', '+ Carregar assets imagem');
    });

    $('#tpage').change((e) => {
        count(e.target.files.length, e, 'Página(s)', '+ Carregar páginas');
    });

    $('#tassetCj').change((e) => {
        count(e.target.files.length, e, 'Arquivo(s)', '+ Carregar assets css/js');
    });

    $('[name="temp_payment_status"]').change((e) => {
        var in_ = $('[name="temp_price"]');
        e.target.value == 'P' ? in_.removeAttr('disabled') : in_.attr('disabled', 'disabled');

        //console.log(in_.removeAttr('disabled'));
    });


});

function count(numFiles, e, type, base) {
    var label = e.target.nextElementSibling;
    var texto = label.innerText
    label.innerText = texto == base ? numFiles + ' ' + type + ' Carregada(s)' : numFiles + ' ' + type + ' Carregada(s)';

}
