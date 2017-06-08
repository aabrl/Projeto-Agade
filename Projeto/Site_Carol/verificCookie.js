//window.location.assign("perfil.php");
//function pegaCookieEmail(name) {
   

   /* var pegaCookies = document.cookie;
    var posicao1 = pegaCookies.indexOf("=");
    var posicao2 = pegaCookies.indexOf(";");
 alert(pegaCookies);
 alert(posicao1);
  alert(posicao2);*/


    /*if (comeco == -1) {
 
        comeco = pegaCookies.indexOf(prefixo);
         
        if (comeco != 0) {
            return null;
        }
 
    } else {
        comeco += 2;
    }
 
    var end = pegaCookies.indexOf(";", comeco);
     
    if (end == -1) {
        end = pegaCookies.length;                        
    }
 
    return unescape(pegaCookies.substring(comeco + prefixo.length, end));
//}*/

var pegaCookies = document.cookie;
var temEmail = pegaCookies.indexOf('email');
if (temEmail != -1) { //quando é -1, é pq não existe na string
	window.location.assign("perfil.php");
} else {
	alert('não tem cookie js');
}