// Script untuk multiple input
$(document).ready(function() {
    // Jumlah input maks
    var maxGroup = 15;

    // Multiple input
    $(".addMore").click(function() {
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        } else {
            alert ('Maksimal '+maxGroup+' data dapat ditambahkan');
        }
    });

    // Remove field group
    $("body").on("click",".remove",function() {
        $(this).parents(".fieldGroup").remove();
    });
});

// Script untuk kelola kategori pengeluaran
$(document).ready(function() {
    // Edit
    $('.btn-edit').on('click', function() {
        // Ambil data btn edit
        const id = $(this).data('id');
        const nama = $(this).data('name');
        const kode = $(this).data('code');
        // Set data ke form edit
        $('.kategori_id').val(id);
        $('.nama_kategori').val(nama);
        $('.kode_kategori').val(kode);
        // Panggil modal edit
        $('#editCatModal').modal('show');
    });

    // Delete
    $('.btn-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('id');
        // Set data ke form delete
        $('.kategoriID').val(id);
        // Panggil modal delete
        $('#deleteCatModal').modal('show');
    });
});



// Script untuk kelola pengajuan pengeluaran
$(document).ready(function() {
    // Delete
    $('.submit-delete').on('click', function() {
        // Ambil data btn submit delete
        const id = $(this).data('id');
        // Set data ke form delete
        $('.pengajuanID').val(id);
        // Panggil modal delete
        $('#deletePengajuanModal').modal('show');
    });

    // Terima
    $('.submit-accept').on('click', function() {
        // Ambil data btn submit accept
        const id = $(this).data('id');
        // Set data ke form
        $('.pengajuanID').val(id);
        // Panggil modal
        $('#terimaPengajuanModal').modal('show');
    });

    // Tolak
    $('.submit-decline').on('click', function() {
        // Ambil data btn submit accept
        const id = $(this).data('id');
        // Set data ke form
        $('.pengajuanID').val(id);
        // Panggil modal
        $('#tolakPengajuanModal').modal('show');
    });

    // Selesaikan
    $('.submit-finish').on('click', function() {
        // Ambil data btn submit accept
        const id = $(this).data('id');
        // Set data ke form
        $('.pengajuanID').val(id);
        // Panggil modal
        $('#finishPengajuanModal').modal('show');
    });
});

function file_pengeluaran() {
    const bukti_pengeluaran = document.querySelector('#bukti_pengeluaran');
    const label_file = document.querySelector('.custom-file-label');
    label_file.textContent = bukti_pengeluaran.files[0].name;
    const file = new FileReader();
    file.readAsDataURL(bukti_pengeluaran.files[0]);
    file.onload = function(e) {

    }
}

function foto_profil() {
    const gbr_profil = document.querySelector('#profile_img');
    const label_profil = document.querySelector('.profile-label');
    const preview_profil = document.querySelector('.img-preview');

    label_profil.textContent = gbr_profil.files[0].name;
    const file_profil = new FileReader();
    file_profil.readAsDataURL(gbr_profil.files[0]);
    file_profil.onload = function(e){
        preview_profil.src = e.target.result;
    }
}

// // Script untuk hitung jumlah otomatis
// $(document).ready(function() {
//     $("#satuan, #jumlah").keyup(function() {
//         var satuan = $("#satuan").val();
//         var jumlah = $("#jumlah").val();
//         var total = parseInt(satuan) * parseInt(jumlah);
//         $("#total").val(total);
//     });
// });