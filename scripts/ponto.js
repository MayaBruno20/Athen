// Função para registrar o ponto
function registerAttendance() {
    const employeeName = document.getElementById('employeeName').value;
    const delayReason = document.getElementById('delayReason').value;
    const action = 'registerAttendance'; // Indica a ação que será executada no backend
    
    // Armazena o employeeName selecionado no armazenamento local
    localStorage.setItem('selectedEmployeeName', employeeName);
  
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
    // Limpa a lista antes de recriá-la
    const logList = document.getElementById('logList');
    logList.innerHTML = '';
  
    // Requisição AJAX para buscar os registros do backend
    fetch('backend.php?action=getAttendanceRecords')
        .then(response => response.json())
        .then(records => {
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
    const employeeName = document.getElementById('employeeName').value;
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
    const employeeName = document.getElementById('employeeName').value;
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
  
  // Chamar a função de exibição ao carregar a página
  window.onload = function() {
    displayAttendanceLog(); // Exibir registro de ponto e ponto de almoço
    
    // Verificar se há um employeeName selecionado anteriormente no armazenamento local
    const selectedEmployeeName = localStorage.getItem('selectedEmployeeName');
    if (selectedEmployeeName) {
        // Define o valor do campo employeeName para o valor armazenado
        document.getElementById('employeeName').value = selectedEmployeeName;
    }
  };
  