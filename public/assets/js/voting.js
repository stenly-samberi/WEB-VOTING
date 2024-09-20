document.addEventListener('DOMContentLoaded', function() {

    let baseUrl = "https://admin.viadolorosa.web.id/";

    const cards = document.querySelectorAll('.card-click');

    let id_register, id_lagu, id_kategori_lomba,no_tampil = null;


    cards.forEach(card => {
        card.addEventListener('click', function() {
          
            cards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            id_register = this.querySelector('#id_register').textContent;
            id_kategori_lomba = this.querySelector('#id_kategori_lomba').textContent;
            no_tampil = this.querySelector('#no_tampil').textContent;


            //Set Value
            document.getElementById("lagu-wajib-value").innerHTML = this.querySelector('#lagu_wajib').value;
            document.getElementById("lagu-pilihan-value").innerHTML = this.querySelector('#lagu_pilihan').value;
        });
    });

    document.getElementById("btn-submit").onclick = function() {
        if (id_register) {

            alert (id_register);

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
                alert('Silakan masukan nilai.');
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
                    id_lagu: id_lagu,
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
                            console.log(response.message);
                        } else if (xhr.status === 422) {
                            let response = JSON.parse(xhr.responseText);
                            let errors = response.errors;
                            let errorMessages = Object.values(errors).map(errorArray => errorArray.join(', ')).join('\n');
                            alert('Validation errors:\n' + errorMessages);
                        } else {
                            console.error('Error:', xhr.statusText);
                        }
                    }
                };
    
                xhr.send(JSON.stringify(data));
            }
        } else {
            alert('Silakan Pilih Peserta lomba');
        }
    };
    
    
    
    
});
