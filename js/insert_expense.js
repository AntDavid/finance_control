document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('expense-form');

    form.addEventListener('submit', function (event) {
        const date = document.getElementById('date').value;
        const description = document.getElementById('description').value;
        const amount = document.getElementById('amount').value;
        const category = document.getElementById('category').value;

        if (!date || !description || !amount || !category) {
            alert('Por favor, preencha todos os campos.');
            event.preventDefault();  
        }
    });
});
