//Função para alterar entre Card de login e Card de registro
function hide() {
    const container = document.getElementById('container_login');
    const containerRegister = document.getElementById('container_register');
  
    container.style.display = 'none';
    containerRegister.style.display = 'flex';
  }
  //Função para alterar entre Card de login e Card de registro
  function hideRegister() {
    const container = document.getElementById('container_login');
    const containerRegister = document.getElementById('container_register');
  
    container.style.display = 'flex';
    containerRegister.style.display = 'none';
  }
  
  //Função para verificar se a senha é a mesma nos input de registro
  function validatePassword() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm_password').value;
  
    if (password === confirmPassword) {
      //
    } else {
      alert('Senhas não coincidem. Por favor, verifique.')
    }
  }
  
  document.getElementById("btn_register").addEventListener("click", validatePassword);
  
  //Função para abrir Card para adicionar itens
  function hideAddItens(){
    const addItemContainer = document.getElementById("add-item-container");
    addItemContainer.style.display = "block";
  }
  
  function closeAddItens(){
    const addItemContainer = document.getElementById("add-item-container"); 
    addItemContainer.style.display = "none";
  }
  