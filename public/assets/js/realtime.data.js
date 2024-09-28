$(document).ready(function() {


function formatNomorTampil(nomor) {
    return nomor < 10 ? '0' + nomor : nomor;
}

function showErrorModal(message) {
    document.getElementById('errorMessages').innerHTML = message;
    let errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
}


    function fetchHasil() {
        $.ajax({
            url: '/dash/data', // URL endpoint untuk mengambil data
            method: 'GET',
            success: function(response) {
                console.log(response); // Tambahkan ini untuk melihat data yang diterima
                var tbody = $('#data-table tbody');
                tbody.empty(); // Kosongkan tbody sebelum menambahkan data baru
    
                // Iterasi objek response.data
                $.each(response.data, function(key, view) {
                    var medalClass = '';
                    switch (view.medali) {
                        case 'Gold':
                            medalClass = 'bg-success';
                            break;
                        case 'Silver':
                            medalClass = 'bg-secondary';
                            break;
                        case 'Bronze':
                            medalClass = 'bg-danger';
                            break;
                        default:
                            medalClass = 'bg-primary';
                            break;
                    }
    
                    var row = `<tr>
                        <td><h6 class="fw-semibold mb-0">${view.nomor_tampil}</h6></td>
                        <td><h6 class="fw-semibold mb-1">${view.jemaat}</h6></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge ${medalClass} rounded-3 fw-semibold">${view.medali}</span>
                            </div>
                        </td>
                        <td><h6 class="fw-semibold mb-0 fs-4">${view.total_final}</h6></td>
                    </tr>`;
                    tbody.append(row);
                });
    
                // Jika tidak ada data, tampilkan pesan "No data available"
                if (Object.keys(response.data).length === 0) {
                    tbody.append('<tr><td colspan="4" class="text-center">No data available</td></tr>');
                }
            },
            error: function() {
                showErrorModal('Failed to fetch data.');
            }
        });
    }

    fetchHasil()
    setInterval(fetchHasil, 5000); // Refresh every 5 seconds
   

    function fetchPeserta() {
        $.ajax({
            url: '/nomor_tampil/data',
            method: 'GET',
            success: function(data) {
                $('#peserta-container').empty();
                $.each(data, function(index, p) {
                  
                    $('#peserta-container').append(
                        '<div class="col-md-4 mb-1">' +
                            '<div class="card">' +
                                '<div class="card-body">' +
                                    '<h3 class="card-title text-center">' + p.data_jemaat.nama + '</h3>' +
                                    '<p class="card-text text-center">' + p.kategori_lomba.kategori_lomba + '</p>' +
                                    '<h1 class="card-text text-center">' + formatNomorTampil(p.no_tampil) + '</h1>' +
                                    '<div class="form-check text-center">' +
                                        '<input class="form-check-input" type="checkbox" value="" id="checklist' + p.id_register + '" ' 
                                        + (p.status == 1 ? 'checked' : '') 
                                        + ' onchange="updateStatus(' + p.id_register + ', this.checked)"/>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );
                    
                });
            }
        });
    }

    fetchPeserta();
    setInterval(fetchPeserta, 5000); // Refresh every 5 seconds


    function fetchPeserta_tampil_to_juri() {
        let id_register, id_lagu, id_kategori_lomba, no_tampil = null;

        $.ajax({
            url: '/review/data',
            method: 'GET',
            success: function(data) {
                $('#review-container').empty();
                $.each(data, function(index, p) {
                    $('#review-container').append(
                        '<div class="col-md-4 mb-1">' +
                            '<div class="card card-click">' +
                                '<div class="card-body">' +
                                    '<label hidden id="id_register" for="">' + p.data_jemaat.id_njemaat + '</label>' +
                                    '<h3 class="card-title text-center">' + p.data_jemaat.nama + '</h3>' +
                                    '<h6 class="text-center" for="">' + p.kategori_lomba.kategori_lomba + '</h6>' +
                                    '<h6 hidden class="text-center" id="id_kategori_lomba" for="">' + p.kategori_lomba.id_kategori_lomba + '</h6>' +
                                    '<h1 id="no_tampil" class="card-text text-center">' + formatNomorTampil(p.no_tampil) + '</h1>' +
                                    '<input id="lagu_wajib" type="text" value="' + p.lagu_wajib + '" hidden>' +
                                    '<input id="id_lagu_wajib" type="text" value="' + p.lagu_wajib + '" hidden>' +
                                    '<input id="lagu_pilihan" type="text" value="' + p.data_lagu.judul + '" hidden>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );
                });
    
                // Tambahkan event listener setelah elemen-elemen baru ditambahkan ke DOM
                const cards = document.querySelectorAll('.card-click');
               
                cards.forEach(card => {
                    card.addEventListener('click', function() {
                       
                        cards.forEach(c => c.classList.remove('selected'));
                        this.classList.add('selected');

                        id_register = this.querySelector('#id_register').textContent;
                        id_kategori_lomba = this.querySelector('#id_kategori_lomba').textContent;
                        no_tampil = this.querySelector('#no_tampil').textContent;

                        // Set Value
                        document.getElementById("lagu-wajib-value").innerHTML = this.querySelector('#lagu_wajib').value;
                        document.getElementById("lagu-pilihan-value").innerHTML = this.querySelector('#lagu_pilihan').value;
                    });
                });

                if (cards.length > 0) {
                    cards[0].classList.add('selected');
                    const firstCard = cards[0];
                    id_register = firstCard.querySelector('#id_register').textContent;
                    id_kategori_lomba = firstCard.querySelector('#id_kategori_lomba').textContent;
                    no_tampil = firstCard.querySelector('#no_tampil').textContent;
            
                    // Set Value
                    document.getElementById("lagu-wajib-value").innerHTML = firstCard.querySelector('#lagu_wajib').value;
                    document.getElementById("lagu-pilihan-value").innerHTML = firstCard.querySelector('#lagu_pilihan').value;
                }
            }
        });

        document.getElementById("btn-submit").onclick = function() {
            if (id_register) {
                let id_user = document.getElementById("id_user").value;
                let title_lagu_wajib = document.getElementById("title_lagu_wajib").innerHTML;
                let title_lagu_pilihan = document.getElementById("title_lagu_pilihan").innerHTML;
        
                let lagu_wajib_value = document.getElementById("lagu-wajib-value").innerHTML;
                let lagu_pilihan_value = document.getElementById("lagu-pilihan-value").innerHTML;
                
                let intonasi_lagu_wajib = document.getElementById("intonasi_lagu_wajib").value;
                let vocal_lagu_wajib = document.getElementById("vocal_lagu_wajib").value;
                let partitur_lagu_wajib = document.getElementById("partitur_lagu_wajib").value;
                let kesan_artistik_lagu_wajib = document.getElementById("kesan_artistik_lagu_wajib").value;
        
                let intonasi_lagu_pilihan = document.getElementById("intonasi_lagu_pilihan").value;
                let vocal_lagu_pilihan = document.getElementById("vocal_lagu_pilihan").value;
                let partitur_lagu_pilihan = document.getElementById("partitur_lagu_pilihan").value;
                let artitistik_lagu_pilihan = document.getElementById("artitistik_lagu_pilihan").value;
        
                if (!intonasi_lagu_wajib || !no_tampil || !id_kategori_lomba  || !title_lagu_pilihan|| !title_lagu_wajib|| !lagu_wajib_value|| !lagu_pilihan_value|| !vocal_lagu_wajib || !partitur_lagu_wajib || !kesan_artistik_lagu_wajib ||
                    !intonasi_lagu_pilihan || !vocal_lagu_pilihan || !partitur_lagu_pilihan || !artitistik_lagu_pilihan) {
                    showErrorModal('Anda belum lengkapi semua data penilaian');
                    return;
                } else {
                    let data = {
                        title_lagu_wajib: title_lagu_wajib,
                        title_lagu_pilihan: title_lagu_pilihan,
                        lagu_wajib_value: lagu_wajib_value,
                        lagu_pilihan_value: lagu_pilihan_value,
                        id_register: id_register,
                        id_kategori_lomba: id_kategori_lomba,
                        no_tampil : no_tampil,
                        id_user: id_user,
                        
                        intonasi_wajib: intonasi_lagu_wajib,
                        vocal_wajib: vocal_lagu_wajib,
                        partitur_wajib: partitur_lagu_wajib,
                        artitistik_wajib: kesan_artistik_lagu_wajib,
                        intonasi_pilihan: intonasi_lagu_pilihan,
                        vocal_pilihan: vocal_lagu_pilihan,
                        partitur_pilihan: partitur_lagu_pilihan,
                        artitistik_pilihan: artitistik_lagu_pilihan,
                    };
        
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "https://admin.viadolorosa.web.id/api/penilaian", true);
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let response = JSON.parse(xhr.responseText);
                                alert(response.message);
                                showErrorModal(response.message);
                                console.log(response.message);
                            } else if (xhr.status === 422) {
                                let response = JSON.parse(xhr.responseText);
                                let errors = response.errors;
                                let errorMessages = Object.values(errors).map(errorArray => errorArray.join(', ')).join('\n');
                                showErrorModal(errorMessages);
                            } else {
                                showErrorModal(xhr.statusText);
                            }
                        }
                    };
        
                    xhr.send(JSON.stringify(data));
                }
            } else {
                showErrorModal('Anda belum memilih peserta untuk penilaian.');
            }
        };

    }

    fetchPeserta_tampil_to_juri();
    setInterval(fetchPeserta_tampil_to_juri, 5000);
   
});

function updateStatus(id,isChecked) {
    var xhr = new XMLHttpRequest();
    var url = '/api/updateStatus'; // Sesuaikan dengan route yang Anda definisikan

    var params = 'id=' + id + '&status=' + (isChecked ? 'true' : 'false');

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send(params);
}

