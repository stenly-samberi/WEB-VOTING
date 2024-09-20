

function displayJemaat(jemaatData){
    var jemaatselect = document.getElementById('jemaat-select');
    jemaatData.forEach(function(jemaat){
        var option = document.createElement('option');
        option.value = jemaat.idj;
        option.textContent = jemaat.nama;
        jemaatselect.appendChild(option);
    });
}

function kategoriLomba(kategoriData){
    var kategoriselect = document.getElementById('kategori-select');
    kategoriData.forEach(function(x){
        var option = document.createElement('option');
        option.value = x.idk;
        option.textContent = x.kategori;
        kategoriselect.appendChild(option);
    });
}

function laguBykategori(data){
    var kategoriSelect = document.getElementById('kategori-select');
    var laguPilihanSelect = document.getElementById('lagu-pilihan');
    var laguWajibInput = document.getElementById('lagu-wajib');

    data.kategori.forEach(function(kategori) {
        var option = document.createElement('option');
        option.value = kategori.idk;
        option.textContent = kategori.kategori;
        kategoriSelect.appendChild(option);
    });

        // Mendengarkan perubahan pada dropdown select kategori
    kategoriSelect.addEventListener('change', function() {
        // Mendapatkan nilai kategori yang dipilih
        var selectedKategori = kategoriSelect.value;

        // Mendapatkan lagu wajib pertama yang sesuai dengan kategori yang dipilih
        var laguWajib = data.lagu.find(function(lagu) {
            return lagu.idk == selectedKategori && lagu.genre === 'Wajib';
        });

        // Memperbarui nilai input lagu wajib jika ditemukan
        if (laguWajib) {
            laguWajibInput.value = laguWajib.judul;
        } else {
            laguWajibInput.value = ''; // Kosongkan input teks jika tidak ada lagu wajib yang sesuai
        }

        // Memuat ulang daftar lagu pilihan sesuai dengan kategori yang dipilih
        reloadLaguPilihan(selectedKategori);
    });

    // Fungsi untuk memuat ulang daftar lagu pilihan sesuai dengan kategori yang dipilih
    function reloadLaguPilihan(selectedKategori) {
        // Menghapus semua opsi pada dropdown select lagu pilihan
        laguPilihanSelect.innerHTML = '<option value="">Pilih Lagu</option>';

        // Menampilkan lagu-lagu sesuai dengan kategori yang dipilih
        data.lagu.forEach(function(lagu) {
            if (lagu.idk == selectedKategori && lagu.genre !=='Wajib') {
                var option = document.createElement('option');
                option.value = lagu.idl;
                option.textContent = lagu.judul;
                laguPilihanSelect.appendChild(option);
            }
        });
    }
}


function fetchData() {
    let baseUrl = "https://admin.viadolorosa.web.id";
    // Membuat objek XMLHttpRequest
    var xhr = new XMLHttpRequest();
    // Menentukan metode, URL, dan asynchronousnya
    xhr.open('GET', baseUrl+'/api/register', true);
    // Mengatur tindakan yang dilakukan saat permintaan selesai
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Menguraikan respons JSON
            var data = JSON.parse(xhr.responseText);
            // Memanggil fungsi untuk menampilkan data
            
            laguBykategori(data);
            displayJemaat(data.jemaat);
        } else {
            console.log('Permintaan gagal. Status: ' + xhr.status);
            alert("Permintaan gagal. Status " + xhr.status);
        }
    };
    // Mengatur tindakan yang dilakukan saat terjadi kesalahan
    xhr.onerror = function() {
       alert("Terjadi kesalahan saat melakukan permintaan.");
    };
    // Mengirim permintaan
    xhr.send();
}



//simpan data keserver menggunakan form
document.getElementById('btn-daftar').addEventListener('click', function() {
    let baseUrl = "https://admin.viadolorosa.web.id";
    var jemaat = document.getElementById('jemaat-select').value;
    var kordinator = document.getElementById('kordinator-input').value;
    var phone = document.getElementById('phone-input').value;
    var kategori = document.getElementById('kategori-select').value;
    var laguWajib = document.getElementById('lagu-wajib').value;
    var laguPilihan = document.getElementById('lagu-pilihan').value;

    // Contoh validasi sederhana
    if (!jemaat || !kordinator || !phone || !kategori || !laguPilihan) {
        alert('Data belum lengkap.');
        return;
    }

    // Buat objek JSON yang berisi data yang akan dikirim
    var data = {
        id_njemaat: jemaat,
        kordinator: kordinator,
        phone: phone,
        kategori: kategori,
        laguWajib: laguWajib,
        laguPilihan: laguPilihan
    };

    // Kirim data ke Laravel menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl+'/api/register', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            var responseData = JSON.parse(xhr.responseText);
            // Tampilkan pesan respons dalam alert
            alert(responseData.message);
            // Arahkan pengguna ke URL redirect jika ada
            if (responseData.redirect_url) {
                window.location.href = responseData.redirect_url;
            }
           
        } else {
                var errorResponse = JSON.parse(xhr.responseText);

                // alert (errorResponse);

                if (errorResponse.hasOwnProperty('id_njemaat')) {
                    var errorMessageLabel = document.getElementById('namaError');
                    errorMessageLabel.textContent = errorResponse['id_njemaat'][0];
                    errorMessageLabel.style.display = 'block';

                }
                
                if(errorResponse.hasOwnProperty('kordinator')){
                    var errorMessageLabel = document.getElementById('kordinatorError');
                    errorMessageLabel.textContent = errorResponse['kordinator'][0];
                    errorMessageLabel.style.display = 'block';
                }

                if(errorResponse.hasOwnProperty('phone')){
                    var errorMessageLabel = document.getElementById('phoneError');
                    errorMessageLabel.textContent = errorResponse['phone'][0];
                    errorMessageLabel.style.display = 'block';
                }

                if(errorResponse.hasOwnProperty('kategori')){
                    var errorMessageLabel = document.getElementById('kategoriError');
                    errorMessageLabel.textContent = errorResponse['kategori'][0];
                    errorMessageLabel.style.display = 'block';
                }

                if(errorResponse.hasOwnProperty('laguWajib')){
                    var errorMessageLabel = document.getElementById('wajibError');
                    errorMessageLabel.textContent = errorResponse['laguWajib'][0];
                    errorMessageLabel.style.display = 'block';
                }

                if(errorResponse.hasOwnProperty('laguPilihan')){
                    var errorMessageLabel = document.getElementById('pilihanError');
                    errorMessageLabel.textContent = errorResponse['laguPilihan'][0];
                    errorMessageLabel.style.display = 'block';
                }
           
        }
    };
    xhr.onerror = function () {
        // Gagal melakukan permintaan
        alert('Terjadi kesalahan. Silakan coba lagi.');
    };
    xhr.send(JSON.stringify(data));
});

