document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-click');
    let id_register,id_user,id_lagu= null;

    cards.forEach(card => {
        card.addEventListener('click', function() {
            cards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            id_register = this.querySelector('#id_register').textContent;


            //Set Value
            document.getElementById("lagu-wajib-value").innerHTML = this.querySelector('#lagu_wajib').value;
            document.getElementById("lagu-pilihan-value").innerHTML = this.querySelector('#lagu_pilihan').value;
            
        });
    });

    document.getElementById("btn-submit").onclick = function() {
        if (id_register) {
            alert(id_register);
        } else {
            alert('Silakan, pilih peserta lomba');
        }
    };
});
