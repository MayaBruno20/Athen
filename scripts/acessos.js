function showAccess(platform) {
    var modal = document.getElementById("modal");
    var platformTitle = document.getElementById("platformTitle");
    var emailElement = document.getElementById("email");
    var senhaElement = document.getElementById("senha");
    var linkElement = document.getElementById("link");

    // Definir os detalhes da plataforma
    switch(platform) {
        case "segfy":
            platformTitle.textContent = "Acesso Segfy";
            emailElement.textContent = "email@segfy.com";
            senhaElement.textContent = "senha123";
            linkElement.textContent = "Segfy";
            linkElement.setAttribute("href", "https://www.segfy.com");
            break;
        case "brad":
            platformTitle.textContent = "Acesso Bradesco";
            emailElement.textContent = "";
            senhaElement.textContent = "";
            linkElement.textContent = "Bradesco";
            linkElement.setAttribute("href", "https://www.bradesco.com.br");
            break;
        case "porto":
            platformTitle.textContent = "Acesso Porto Seguro";
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

    // Salvar os dados ao clicar no botão de salvar
    var saveBtn = document.querySelector("#modal button");
    saveBtn.addEventListener("click", function() {
        var email = document.getElementById("email").textContent;
        var senha = document.getElementById("senha").textContent;

        // Enviar os dados para o servidor via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "acessos.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Verificar se os dados foram salvos com sucesso
                console.log(xhr.responseText);
                // Fechar a modal após salvar os dados
                modal.style.display = "none";
            }
        };
        var params = "platform=" + encodeURIComponent(platform) + "&email=" + encodeURIComponent(email) + "&senha=" + encodeURIComponent(senha);
        xhr.send(params);
    });
}
