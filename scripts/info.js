function makeEditable(element) {
    if (element.tagName === 'INPUT') return;

    var input = document.createElement('input');
    input.type = 'text';
    input.value = element.innerText.replace('R$', '').trim();

    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (isNaN(input.value)) {
                alert("Por favor, insira um valor numérico.");
                return;
            }
            saveChanges(element, input.value);
            element.innerText = 'R$' + input.value;
            input.parentNode.replaceChild(element, input);
        }
    });

    element.parentNode.replaceChild(input, element);
    input.focus();
    input.setSelectionRange(input.value.length, input.value.length);
}

function makeEditablePorcentagem(element) {
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

function saveChanges(element, newValue) {
    var data = {
        id: 'custo',
        value: newValue
    };

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

function saveChangesPorcentagem(element, newValue) {
    var data = {
        id: 'porcentagem',
        value: newValue
    };

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
    xhr.open("GET", "buscar_porcentagem.php", true); // Supondo que o arquivo PHP responsável por buscar a porcentagem seja "buscar_porcentagem.php"
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

window.onload = function() {
    console.log("A página foi carregada. Chamando a função exibirValorPorcentagem()");
    exibirValorCusto();
    exibirValorPorcentagem(); // Chama a função para exibir a porcentagem quando a página é carregada
};

