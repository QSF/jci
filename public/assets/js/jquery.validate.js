$(document).ready(function(){
  $('#idUserForm').validate({
    rules:{
      name:{
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      },
      password: {
        required: true
      },
      confirmPassword:{
        required: true,
        equalTo: "#idPassword"
      },
      phone:{
        required: true
      },
      howYouKnow:{
        required: true
      },
      cpf: {
        required: true,
        verificaCPF: true
      },
      cep: {
        required: true
      },
      cnpj:{
        required: true,
        cnpj: true
      },
      companyName:{
        required: true
      },
      stateRegistration:{
        required: true
      },
      ownerPhone:{
        required: true
      },
      establishmentDate:{
        required: true
      },
    },
    messages:{
      name:{
        required: "Campo Obrigatório",
        minlength: "O campo deve conter no mínimo 3 caracteres"
      },
      email:{
        required: "Campo Obrigatório",
        email: "Forneça um e-mail válido"
                },
      password:{
        required: "Campo Obrigatório"
                },
      confirmPassword:{
        required: "Campo Obrigatório",
        equalTo: "Digite a senha corretamente"
      },
      phone:{
        required: "Campo Obrigatório"
      },
      howYouKnow:{
        required: "Campo Obrigatório"
      },
      cpf:{
        required: "Campo Obrigatório",
        verificaCPF: "Forneça um CPF válido"
      },
      cep:{
        required: "Campo Obrigatório"
      },
      cnpj:{
        required: "Campo Obrigatório",
        cnpj: "Forneça um CNPJ válido"
      },
      companyName:{
        required: "Campo Obrigatório"
      },
      stateRegistration:{
        required: "Campo Obrigatório"
      },
      ownerPhone:{
        required: "Campo Obrigatório"
      },
      establishmentDate:{
        required: "Campo Obrigatório"
      },
    }
  });
});

jQuery(function($){
  $("#idPhone").mask("(99) 9999-9999");
  $("#idCpf").mask("999.999.999-99");
  $("#idCep").mask("99999-999");
  $("#idCnpj").mask("99.999.999/9999-99");
  $("#idStateRegistration").mask("99999999-99");
  $("#idOwnerPhone").mask("(99) 9999-9999");
});

jQuery.validator.addMethod("verificaCPF", function(value, element) {
  value = value.replace('.','');
  value = value.replace('.','');
  cpf = value.replace('-','');

  while(cpf.length < 11) 
    cpf = "0" + cpf;

  var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
  var a = [];
  var b = new Number;
  var c = 11;

  for (i=0; i<11; i++) {
    a[i] = cpf.charAt(i);
    if (i < 9) 
      b += (a[i] * --c);
  }

  if ((x = b % 11) < 2) { 
    a[9] = 0 
  } 

  else { 
    a[9] = 11-x 
  }

  b = 0;
  c = 11;

  for (y=0; y<10; y++)
   b += (a[y] * c--);

  if ((x = b % 11) < 2) { 
    a[10] = 0; 
  } 

  else { 
    a[10] = 11-x; 
  }

  if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) 
    return false;
  
  return true;
}, "Informe um CPF válido."); // Mensagem padrão

jQuery.validator.addMethod("cnpj", function(cnpj, element) {
  cnpj = jQuery.trim(cnpj);// retira espaços em branco
  // DEIXA APENAS OS NÚMEROS
  cnpj = cnpj.replace('/','');
  cnpj = cnpj.replace('.','');
  cnpj = cnpj.replace('.','');
  cnpj = cnpj.replace('-','');
     
  var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
  digitos_iguais = 1;
     
  if (cnpj.length != 14) {
    return false;
  }

  for (i = 0; i < cnpj.length - 1; i++) {
    if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
      digitos_iguais = 0;
      break;
    }
  }
     
  if (!digitos_iguais) {
    tamanho = cnpj.length - 2;
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
     
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2) {
        pos = 9;
      }
    }
          
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    
    if (resultado != digitos.charAt(0)) {
      return false;
    }
          
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2) {
        pos = 9;
      }
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    
    if (resultado != digitos.charAt(1)) {
      return false;
    }
    return true;
  }

  else {
    return false;
  }
}, "Informe um CNPJ válido."); // Mensagem padrão 

$(document).ready(function() {
  $('#idStablishmentDate').focus(function() {
    $(this).calendario({
      target:'#idStablishmentDate',
      //top: 0,
      //left: 180
    });
  });
});