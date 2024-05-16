
// Função para exibir a modal com os detalhes da plataforma
function showAccess(platform) {
    var modal = document.getElementById("modal");
    var platformTitle = document.getElementById("platformTitle");
    var emailElement = document.getElementById("email");
    var senhaElement = document.getElementById("senha");
    var linkElement = document.getElementById("link");

    // Definir os detalhes da plataforma
    switch(platform) {
        case "segfy":
            platformTitle.textContent = "Acesso";
            emailElement.textContent = "contato@prseg.com.br";
            senhaElement.textContent = "senha123";
            linkElement.textContent = "Segfy";
            linkElement.setAttribute("href", "https://www.segfy.com");
            break;
        case "brad":
            platformTitle.textContent = "Acesso";
            emailElement.textContent = "445.624.838-65";
            senhaElement.textContent = "Sadan2023$";
            linkElement.textContent = "Bradesco";
            linkElement.setAttribute("href", "https://login.bradescoseguros.com.br/nidp/app/login?id=secure_name_pasword_form_pneg&option=credential&target=https%3A%2F%2Fwwwn.bradescoseguros.com.br%2Fpnegocios%2Fwps%2Fmyportal%2Fportalnegocios%2Farealogada%2F");
            break;
        case "porto":
            platformTitle.textContent = "Acesso";
            emailElement.textContent = "445.624.838-65";
            senhaElement.textContent = "PRseg1394$";
            linkElement.textContent = "Porto";
            linkElement.setAttribute("href", "https://corretor.portoseguro.com.br/corretoronline/");
            break;
            case "axa":
                platformTitle.textContent = "Acesso";
                emailElement.textContent = "igorpinheirorocha@prseg.com.br";
                senhaElement.textContent = "Maiasadan2024#";
                linkElement.textContent = "Axa";
                linkElement.setAttribute("href", "https://corretor.axa.com.br/portal-corretor/");
                break;
        // Adicione mais casos conforme necessário para outras plataformas
    }

    modal.style.display = "block";

    // Fechar a modal quando clicar no botão de fechar
    var closeBtn = document.querySelector("#modal .close");
    closeBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // Fechar a modal quando clicar fora da área da modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function clearCache() {
    localStorage.clear();
    sessionStorage.clear();
    location.reload();
}

function updateDataBackend() {
    clearCache();
}