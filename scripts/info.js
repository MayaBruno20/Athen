function makeEditable(element) {
    // Verifica se o elemento já está editável para evitar múltiplas edições
    if (element.tagName === 'INPUT') return;

    // Cria um campo de entrada (input) e configura os atributos
    var input = document.createElement('input');
    input.type = 'text';
    input.value = element.innerText.replace('R$', ''); // Remove o 'R$' para deixar apenas o valor

    // Adiciona um event listener para capturar a tecla Enter
    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evita a ação padrão de "Enter" para não inserir uma quebra de linha
            saveChanges(element, input.value); // Salva as alterações no banco de dados
            element.innerText = 'R$' + input.value; // Atualiza o texto do elemento <h2> com o novo valor
            input.parentNode.replaceChild(element, input); // Substitui o input pelo elemento <h2>
        }
    });

    // Substitui o elemento <h2> pelo campo de entrada (input)
    element.parentNode.replaceChild(input, element);

    // Coloca o foco no campo de entrada
    input.focus();
    input.setSelectionRange(input.value.length, input.value.length);
}

function makeEditablePorcentagem(element) {
    // Verifica se o elemento já está editável para evitar múltiplas edições
    if (element.tagName === 'INPUT') return;

    // Cria um campo de entrada (input) e configura os atributos
    var input = document.createElement('input');
    input.type = 'text';
    input.value = element.innerText.replace('%', ''); // Remove o '%' para deixar apenas o valor

    // Adiciona um event listener para capturar a tecla Enter
    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evita a ação padrão de "Enter" para não inserir uma quebra de linha
            saveChangesPorcentagem(element, input.value); // Salva as alterações no banco de dados
            element.innerText = input.value + '%'; // Atualiza o texto do elemento <h1> com o novo valor
            input.parentNode.replaceChild(element, input); // Substitui o input pelo elemento <h1>
        }
    });

    // Substitui o elemento <h1> pelo campo de entrada (input)
    element.parentNode.replaceChild(input, element);

    // Coloca o foco no campo de entrada
    input.focus();
    input.setSelectionRange(input.value.length, input.value.length);
}

function saveChanges(element, newValue) {
    // Prepara os dados para enviar ao servidor
    var data = {
        id: 'custo',
        value: newValue
    };

    // Envia os dados para o servidor usando AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "salvar_dados.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Atualiza o texto do elemento com o novo valor
            element.innerText = 'R$' + newValue;
        }
    };
    xhr.send(JSON.stringify(data));
}

function saveChangesPorcentagem(element, newValue) {
    // Prepara os dados para enviar ao servidor
    var data = {
        id: 'porcentagem', // Identificador para a porcentagem
        value: newValue // Novo valor da porcentagem
    };

    // Envia os dados para o servidor usando AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "salvar_dados.php", true); // Supondo que você tenha um arquivo PHP para salvar a porcentagem
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Atualiza o texto do elemento com o novo valor
            element.innerText = newValue + '%';
        }
    };
    xhr.send(JSON.stringify(data));
}


// Função para buscar e exibir o valor do banco de dados
function exibirValorCusto() {
    // Fazer uma solicitação AJAX para buscar o valor no banco de dados
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "buscar_dados.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Atualizar o conteúdo do elemento h2 com o valor do banco de dados
            var valorComR$ = "R$" + xhr.responseText;
            document.getElementById("custo").innerText = valorComR$;
        }
    };
    xhr.send();
}

// Chamar a função quando a página carregar para exibir o valor inicial
window.onload = function() {
    exibirValorCusto();
};