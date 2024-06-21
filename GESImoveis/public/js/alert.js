// alert.js

document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alert => {
        // Fecha o alerta quando o botão de fechar é clicado
        alert.querySelector('.alert-close').addEventListener('click', function () {
            alert.classList.remove('show');
        });

        // Fecha automaticamente o alerta após 5 segundos
        setTimeout(function () {
            alert.classList.remove('show');
        }, 5000); // Tempo em milissegundos (5 segundos)
    });
});
