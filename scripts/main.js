console.log('Script carregado'); // Log para garantir que o script está sendo carregado

// Função para registrar o ponto
function registerAttendance() {
    const employeeName = loggedInEmployeeName;
    const delayReason = document.getElementById('delayReason').value;
    const action = 'registerAttendance'; // Indica a ação que será executada no backend
    
    // Monta os dados a serem enviados para o backend
    const data = new URLSearchParams();
    data.append('employeeName', employeeName);
    data.append('delayReason', delayReason);
    data.append('action', action);
  
    // Envia os dados para o backend via AJAX
    fetch('backend.php', {
        method: 'POST',
        body: data
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao registrar ponto de presença.');
        }
        return response.text();
    })
    .then(responseText => {
        alert(responseText); // Exibe a resposta do backend
        document.getElementById('delayReason').value = ''; // Limpa o campo de motivo de atraso
        displayAttendanceLog(); // Atualiza a exibição dos registros
    })
    .catch(error => {
        alert(error.message);
    });
}

// Função para exibir o registro de ponto, ponto de almoço e solicitações de saída antecipada
function displayAttendanceLog() {
    console.log('Chamando displayAttendanceLog'); // Log de depuração
    // Limpa a lista antes de recriá-la
    const logList = document.getElementById('logList');
    if (!logList) {
        console.error('Elemento logList não encontrado');
        return;
    }
    logList.innerHTML = '';

    // Requisição AJAX para buscar os registros do backend
    fetch('backend.php?action=getAttendanceRecords')
        .then(response => {
            console.log(response); // Log da resposta
            return response.json();
        })
        .then(records => {
            console.log(records); // Log dos registros
            records.forEach(record => {
                const listItem = document.createElement('li');
                let recordText = `${record.employee_name} - ${record.timestamp}`;

                if (record.delay_reason) {
                    recordText += ` - Motivo: ${record.delay_reason}`;
                }

                listItem.textContent = recordText;
                logList.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Erro ao recuperar registros:', error);
        });
}

// Função para registrar o ponto de almoço
function registerLunchBreak() {
    const employeeName = loggedInEmployeeName;
    const action = 'registerLunchBreak'; // Indica a ação que será executada no backend

    // Monta os dados a serem enviados para o backend
    const data = new URLSearchParams();
    data.append('employeeName', employeeName);
    data.append('action', action);

    // Envia os dados para o backend via AJAX
    fetch('backend.php', {
        method: 'POST',
        body: data
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao registrar ponto de almoço.');
        }
        return response.text();
    })
    .then(responseText => {
        alert(responseText); // Exibe a resposta do backend
        displayAttendanceLog(); // Atualiza a exibição dos registros
    })
    .catch(error => {
        alert(error.message);
    });
}

// Função para solicitar saída antecipada
function requestEarlyOut() {
    const employeeName = loggedInEmployeeName;
    const earlyOutReason = document.getElementById('earlyOutReason').value;
    const action = 'requestEarlyOut'; // Indica a ação que será executada no backend

    // Monta os dados a serem enviados para o backend
    const data = new URLSearchParams();
    data.append('employeeName', employeeName);
    data.append('earlyOutReason', earlyOutReason);
    data.append('action', action);

    // Envia os dados para o backend via AJAX
    fetch('backend.php', {
        method: 'POST',
        body: data
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao solicitar saída antecipada.');
        }
        return response.text();
    })
    .then(responseText => {
        alert(responseText); // Exibe a resposta do backend
        document.getElementById('earlyOutReason').value = ''; // Limpa o campo de motivo de saída antecipada
        displayAttendanceLog(); // Atualiza a exibição dos registros
    })
    .catch(error => {
        alert(error.message);
    });
}

// Função para limpar os registros de ponto e ponto de almoço
function clearLogs() {
    localStorage.removeItem('attendanceRecords');
    localStorage.removeItem('lunchBreakRecords');
    localStorage.removeItem('earlyOutRequests');
    displayAttendanceLog(); // Limpar a exibição dos registros
}

// Função para transformar um elemento de texto em um campo de entrada editável para valores monetários
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
            element.innerText = 'R$' + input.value;
            input.parentNode.replaceChild(element, input);
        }
    });

    // Substitui o elemento original pelo campo de entrada e foca no campo de entrada.
    element.parentNode.replaceChild(input, element);
    input.focus();
    input.setSelectionRange(input.value.length, input.value.length);
}

// Função para transformar um elemento de texto em um campo de entrada editável para valores percentuais
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

// Função para enviar os dados editados para o servidor para serem salvos
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

// Função para enviar os dados percentuais editados para o servidor para serem salvos
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

// Função para fazer uma requisição ao servidor para obter e exibir o valor de custo
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

// Função para fazer uma requisição ao servidor para obter e exibir o valor percentual
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

// Função para carregar o histórico completo de registros na caixa flutuante
function loadFullAttendanceLog() {
    console.log('Chamando loadFullAttendanceLog'); // Log de depuração
    const fullLogList = document.getElementById('fullLogList');
    if (!fullLogList) {
        console.error('Elemento fullLogList não encontrado');
        return;
    }
    fullLogList.innerHTML = '';

    // Requisição AJAX para buscar todos os registros do backend
    fetch('backend.php?action=getFullAttendanceRecords')
        .then(response => {
            console.log(response); // Log da resposta
            return response.json();
        })
        .then(records => {
            console.log(records); // Log dos registros
            records.forEach(record => {
                const listItem = document.createElement('li');
                let recordText = `${record.employee_name} - ${record.timestamp}`;

                if (record.delay_reason) {
                    recordText += ` - Motivo: ${record.delay_reason}`;
                }

                listItem.textContent = recordText;
                fullLogList.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Erro ao recuperar registros:', error);
        });
}

// Função que é executada quando a página é carregada para exibir os valores de custo e porcentagem
window.onload = function() {
    console.log("A página foi carregada. Chamando a função exibirValorPorcentagem()");
    exibirValorCusto();
    exibirValorPorcentagem();
    displayAttendanceLog();
};
