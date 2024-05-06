function openFolder(element) {
    // Encontra os links das pastas correspondentes
    const folderLinks = element.nextElementSibling;
  
    // Alterna a visibilidade dos links das pastas
    if (folderLinks.style.display === 'block') {
      folderLinks.style.display = 'none';
    } else {
      // Fecha todas as pastas abertas antes de abrir a nova
      closeAllFolders();
      folderLinks.style.display = 'block';
    }
  }
  
  function closeAllFolders() {
    // Obtem todos os elementos com a classe 'folder-links'
    const allFolderLinks = document.querySelectorAll('.folder-links');
  
    // Fecha cada link de pasta
    allFolderLinks.forEach(folderLinks => {
      folderLinks.style.display = 'none';
    });
  }
  
  // Fecha pastas abertas se o usuário clicar fora delas
  document.addEventListener('click', function (event) {
    const isClickInsideFolder = event.target.matches('.folders h2, .folder-links, .folder-links *');
    if (!isClickInsideFolder) {
      closeAllFolders();
    }
  });
  