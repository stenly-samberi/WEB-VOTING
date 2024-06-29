document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card-click');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                cards.forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                // const name = this.querySelector('.card-title').textContent;
                // alert(name);
            });
        });
});

