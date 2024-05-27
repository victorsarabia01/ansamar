function validarEmail(email) {
    // Expresión regular para validar el formato del correo electrónico
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }
  
  // Ejemplo de uso
  const emailInput = document.getElementById('emailInput'); // Suponiendo que tengas un input con el id "emailInput"
  const email = emailInput.value;
  
  if (validarEmail(email)) {
    console.log('El correo electrónico es válido');
  } else {
    console.log('El correo electrónico no es válido');
  }
  