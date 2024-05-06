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
            emailElement.textContent = "email@segfy.com";
            senhaElement.textContent = "senha123";
            linkElement.textContent = "https://www.segfy.com";
            linkElement.setAttribute("href", "https://www.segfy.com");
            break;
        case "brad":
            platformTitle.textContent = "Acesso";
            emailElement.textContent = "email@bradesco.com";
            senhaElement.textContent = "senha456";
            linkElement.textContent = "https://www.bradesco.com.br";
            linkElement.setAttribute("href", "https://www.bradesco.com.br");
            break;
        case "porto":
            platformTitle.textContent = "Acesso";
            emailElement.textContent = "445.624.838-65";
            senhaElement.textContent = "PRseg1394$";
            linkElement.textContent = "Porto";
            linkElement.setAttribute("href", "https://corretor.portoseguro.com.br/corretoronline/");
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