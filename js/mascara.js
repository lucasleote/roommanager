/*limita o nro de caracteres do textarea*/
function limitaTextarea(valor) {
   quantidade = 500;
   total = valor.length;

   if(total <= quantidade) {
      resto = quantidade- total;
      document.getElementById('contador').innerHTML = resto;
   } else {
      document.getElementById('texto').value = valor.substr(0, quantidade);
   }
}

/*permite somente valores numericos*/
function valCPF(e,campo){
 
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58 )){
        mascara(campo, '###.###.###-##');
        return true;
      }
    else{
    if (tecla != 8 ) return false;
    else return true;
    }
}

/*permite somente valores numericos*/
function valPHONE(e,campo){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58 )){
        mascara(campo, '(##)####-####');
        return true;
      }
    else{
    if (tecla != 8 ) return false;
    else return true;
    }
}

/*permite somente valores numericos*/
function valCEP(e,campo){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58 )){
        mascara(campo, '#####-###');
        return true;
      }
    else{
    if (tecla != 8 ) return false;
    else return true;
    }
}

/*função que monta a máscara*/
function mascara(src, mask){
   var i = src.value.length;
   var saida = mask.substring(1,2);
   var texto = mask.substring(i)
    if (texto.substring(0,1) != saida) {
      src.value += texto.substring(0,1);
    }
} 
