/**
 * Transforma um elemento de texto em um campo de entrada editável para valores monetários.
 * @param {HTMLElement} element - O elemento HTML que será transformado em um campo de entrada.
 */


function makeEditable(element) {
    // Verifica se o elemento já é um campo de entrada. Se for, retorna sem fazer nada.
    if (element.tagName === 'INPUT') return;

    // Cria um novo campo de entrada do tipo texto.
    var input = document.createElement('input');
    input.type = 'text';
    // Define o valor do campo de entrada removendo o símbolo 'R$' e espaços em branco.
    input.value = element.innerText.replace('R$', '').trim();

    // Adiciona um evento de escuta para detectar quando a tecla "Enter" é pressionada.
    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();

            // Verifica se o valor inserido é numérico.
            if (isNaN(input.value)) {
                alert("Por favor, insira um valor numérico.");
                return;
            }

            // Chama a função para salvar a alteração e atualiza o texto do elemento original.
            saveChanges(element, input.value);
            saveChanges(element, input.value);
            element.innerText = 'R$' + input.value;
            input.parentNode.replaceChild(element, input);
        }
    });

    // Substitui o elemento original pelo campo de entrada e foca no campo de entrada.
    element.parentNode.replaceChild(input, element);
    input.focus();
    input.setSelectionRange(input.value.length, input.value.length);
}

/**
 * Transforma um elemento de texto em um campo de entrada editável para valores percentuais.
 * @param {HTMLElement} element - O elemento HTML que será transformado em um campo de entrada.
 */

function makeEditablePorcentagem(element) {
    // Verifica se o elemento já é um campo de entrada. Se for, retorna sem fazer nada.
    if (element.tagName === 'INPUT') return;

    var input = document.createElement('input');
    input.type = 'text';
    input.value = element.innerText.replace('%', '').trim();

    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (isNaN(input.value)) {
                alert("Por favor, insira um valor numérico.");
                return;
            }
            saveChangesPorcentagem(element, input.value);
            element.innerText = input.value + '%';
            input.parentNode.replaceChild(element, input);
        }
    });

    element.parentNode.replaceChild(input, element);
    input.focus();
    input.setSelectionRange(input.value.length, input.value.length);
}

/**
 * Envia os dados editados para o servidor para serem salvos.
 * @param {HTMLElement} element - O elemento HTML que contém o valor a ser salvo.
 * @param {string} newValue - O novo valor que deve ser salvo.
 */

function saveChanges(element, newValue) {
    var data = {
        id: 'custo',
        value: newValue
    };
    // Configura uma requisição XMLHttpRequest do tipo POST para enviar os dados.
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "salvar_dados.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                element.innerText = 'R$' + newValue;
            } else {
                alert("Erro ao salvar os dados: " + xhr.statusText);
            }
        }
    };
    xhr.send(JSON.stringify(data));
}

/**
 * Envia os dados percentuais editados para o servidor para serem salvos.
 * @param {HTMLElement} element - O elemento HTML que contém o valor a ser salvo.
 * @param {string} newValue - O novo valor que deve ser salvo.
 */

function saveChangesPorcentagem(element, newValue) {
    var data = {
        id: 'porcentagem',
        value: newValue
    };

    // Configura uma requisição XMLHttpRequest do tipo POST para enviar os dados.
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "salvar_dados.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                element.innerText = newValue + '%';
            } else {
                alert("Erro ao salvar os dados: " + xhr.statusText);
            }
        }
    };
    xhr.send(JSON.stringify(data));
}


/*** Faz uma requisição ao servidor para obter e exibir o valor de custo.*/
function exibirValorCusto() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "buscar_dados.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var valorComR$ = "R$" + xhr.responseText;
                document.getElementById("custo").innerText = valorComR$;
            } else {
                alert("Erro ao buscar os dados: " + xhr.statusText);
            }
        }
    };
    xhr.send();
}

function exibirValorPorcentagem() {
    console.log("Iniciando a função exibirValorPorcentagem()");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "buscar_porcentagem.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log("Estado da requisição: " + xhr.readyState);
            if (xhr.status == 200) {
                console.log("Resposta recebida com sucesso!");
                var valorPorcentagem = xhr.responseText;
                console.log("Valor da porcentagem recebido: " + valorPorcentagem);
                document.getElementById("porcentagem").innerText = valorPorcentagem + '%';
            } else {
                console.log("Erro ao receber resposta: " + xhr.status);
                alert("Erro ao buscar os dados de porcentagem: " + xhr.statusText);
            }
        }
    };
    xhr.send();
}

// Função que é executada quando a página é carregada para exibir os valores de custo e porcentagem.
window.onload = function() {
    console.log("A página foi carregada. Chamando a função exibirValorPorcentagem()");
    exibirValorCusto();
    exibirValorPorcentagem();
};

