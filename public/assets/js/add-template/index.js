$('document').ready(() => {

    $('[name="temp_payment_status"]').change((e) => {
        var in_ = $('[name="temp_price"]');
        e.target.value == 'P' ? in_.removeAttr('disabled') : in_.attr('disabled', 'disabled');


        //console.log(in_.removeAttr('disabled'));
    });


    const images = new Array();
    const assets = new Array();
    const pages = new Array();
    const cover = new Array();

    document.getElementById('temp_cover').addEventListener('change', (e) => {
        var reader = new FileReader();

        var item = {
            file: null,
            name: ''
        };

        const fileName = e.target.files[0].name;

        reader.onload = function (event) {
            item.file = event.target.result
            item.name = fileName;

            var container = e.target.nextElementSibling;
            container.classList.length < 2 ? container.classList.add('active') : '';
            var img = e.target.nextElementSibling.querySelector('img');
            img.src = '';
            img.src = item.file;
        };
        reader.readAsDataURL(e.target.files[0]);

        cover.push(item);
    });

    document.getElementById('temp_images').addEventListener('change', function (e) {
        const files = this.files;

        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();

            // Crie um objeto para representar cada página com campos 'file' e 'name'
            const image = {
                file: null,
                name: '',
            };

            const fileName = files[i].name;

            reader.onload = function (event) {
                image.file = event.target.result;
                // Associar o nome do arquivo com a página correspondente
                image.name = fileName;
                count(images.length, e, 'Imagem(ns)', '+ Carregar assets imagem');
            };

            reader.readAsDataURL(files[i]);

            images.push(image);
        }
    });

    document.getElementById('temp_pages').addEventListener('change', function (e) {
        const files = this.files;

        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();

            // Crie um objeto para representar cada página com campos 'file' e 'name'
            const page = {
                file: null,
                name: '',
            };

            const fileName = files[i].name;

            reader.onload = function (event) {
                page.file = event.target.result;
                page.name = fileName;
                count(pages.length, e, 'Página(s)', '+ Carregar páginas');
            };

            reader.readAsDataURL(files[i]);

            pages.push(page);
        }
    });

    document.getElementById('temp_assets').addEventListener('change', function (e) {
        const files = this.files;

        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();

            const asset = {
                file: null,
                name: '',
            };

            const fileName = files[i].name;

            reader.onload = function (event) {
                asset.file = event.target.result;
                asset.name = fileName;
                count(assets.length, e, 'Arquivo(s)', '+ Carregar assets css/js');
            };

            reader.readAsDataURL(files[i]);

            assets.push(asset);
        }
    });


    $('#btn-add-template').click((e) => {

        e.preventDefault();

        let dataForm = {

            temp_title: $('#temp_title').val(),

            temp_description: $('#temp_description').val(),

            temp_editable: $('#temp_editable').val(),

            temp_price: $('#temp_price').val(),

            temp_payment_status: $('#temp_payment_status').val(),

            temp_type: $('#temp_type').val(),

        }


        const data = {
            dataForm: dataForm,
            cover: cover,
            images: images,
            pages: pages,
            assets: assets
        };

        console.log(images);

        const url = 'http://localhost:5000/api/template';
        fetch(url, {
            method: 'POST',
            //mode: 'no-cors',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Erro na solicitação');
                }
            })
            .then(data => {
                console.log('Resposta da API:', data);
            })
            .catch(error => {
                console.error('Erro:', error);
            });

        /*
        $.ajax({
            url: 'http://localhost:5000/api/template',
            type: 'POST',
            data: {
                data: dataForm,
                temp_images: bs64,
            },
            success: function (res) {
                console.log(res);
                return;
            },
            error: function (res) {
                console.log('erro');
            }
        })*/

    });

});

function count(numFiles, e, type, base) {
    var label = e.target.nextElementSibling;
    var texto = label.innerText
    label.innerText = texto == base ? numFiles + ' ' + type + ' Carregada(s)' : numFiles + ' ' + type + ' Carregada(s)';

}
