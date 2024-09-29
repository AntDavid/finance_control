const toggleMenuButton = document.getElementById('toggle-menu');
const menuOptions = document.getElementById('menu-options');

toggleMenuButton.addEventListener('click', function() {
    menuOptions.classList.toggle('hidden');
});

function loadFinancialData() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_financial_data.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('financial-data').innerHTML = this.responseText;
        }
    };
    xhr.send();
}

window.onload = loadFinancialData;
