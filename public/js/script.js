$(function() {
    var BASEURL     = 'http://localhost/tokolaku/public';
    var IMGBASEURL  = 'http://localhost/tokolaku/public/imgs/upload/';
    
    //Categories Menu
    $('.btnAddCategories').on('click', function() {
        $('#modalFormCategoryLabel').html('Buat Kategori');
        $('.modal-footer button[type=submit]').html('Tambah');
        $('#name').val('');
        $('#description').val('');
        $('#image').attr('src', IMGBASEURL + 'upload.svg');
        $('#upload').val(null);

        $('.modal-body form').attr('action', BASEURL + '/admin/addProductCategory');
    });

    $('.btnUpdateCategories').on('click', function() {
        $('#modalFormCategoryLabel').html('Ubah Kategori');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#upload').val(null);

        $('.modal-body form').attr('action', BASEURL + '/admin/updateProductCategory');

        const id = $(this).data('id');
        
        $.ajax({
            url         : 'http://localhost/tokolaku/public/admin/getProductCategory',
            data        : { id : id },
            method      : 'POST',
            dataType    : 'json',
            success     : function(data) {
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#image').attr('src', IMGBASEURL + data.image);
                $('#oldImage').val(data.image);
            }
        });
    });

    $('#upload').on('change', function() {
        const preview = document.querySelector('#image');
        const file = document.querySelector('#upload').files[0];
        const reader = new FileReader();
      
        reader.addEventListener('load', function (){
            preview.src = reader.result;
        }, false);
      
        if(file){
            reader.readAsDataURL(file);
        }
    });

    //Product Menu
    $('.btnAddProduct').on('click', function() {
        $('#modalFormProductLabel').html('Buat Produk');
        $('.modal-footer button[type=submit]').html('Tambah');

        $('#name').val('');
        $('#category_id').val('');
        $('#stock').val('');
        $('#price').val('');
        $('#description').val('');
        $('#image').attr('src', IMGBASEURL + 'upload.svg');
        $('#upload').val(null);

        $('.modal-body form').attr('action', 'http://localhost/tokolaku/public/admin/addProduct');

    });

    $('.btnUpdateProduct').on('click', function() {
        $('#modalFormProductLabel').html('Ubah Produk');
        $('.modal-footer button[type=submit]').html('Simpan');
        $('#upload').val(null);

        $('.modal-body form').attr('action', BASEURL + '/admin/updateProduct');

        const id = $(this).data('id');
        
        $.ajax({
            url         : 'http://localhost/tokolaku/public/admin/getProduct',
            data        : { id : id },
            method      : 'POST',
            dataType    : 'json',
            success     : function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#category_id').val(data.category_id);
                $('#stock').val(data.stock);
                $('#price').val(data.price);
                $('#description').val(data.description);
                $('#image').attr('src', IMGBASEURL + data.image);
                $('#oldImage').val(data.image);
            }
        });
    });
});