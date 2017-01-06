function puntitos(donde,caracter,ndecimales)
{

N = ndecimales; //numero de decimales a generar solo hasta 3 decimales
decimales = true; //si quiero decimales
dec = new Number(N)

//alert(dec);
pat = /[\*,\+,\(,\),\?,\\,\$,\[,\],\^]/
valor = donde.value

largo = valor.length

crtr = true
if(isNaN(caracter) || pat.test(caracter) == true)
	{
	if (pat.test(caracter)==true)
		{caracter = "\\" + caracter}
	carcter = new RegExp(caracter,"g")
	valor = valor.replace(carcter,"")
	donde.value = valor
	crtr = false
	}
else
	{

    var nums = new Array()

         cont = 0
   	   for(m=0;m<largo;m++)
		{
	if(valor.charAt(m) == "." || valor.charAt(m) == " " || valor.charAt(m) == ",")
			{continue;}
		else{
			nums[cont] = valor.charAt(m)
			cont++
			}

		}
	}

if(decimales == true) {
	ctdd = eval(1 + dec);
	nmrs = 1
	}
else {
	ctdd = 1; nmrs = 3
	}
var cad1="",cad2="",cad3="",tres=0
if(largo > nmrs && crtr == true)
	{
	for (k=nums.length-ctdd;k>=0;k--){
		cad1 = nums[k]
		cad2 = cad1 + cad2
		tres++
		if((tres%3) == 0){
			if(k!=0){
				cad2 = "." + cad2
				}
			}
		}

	for (dd = dec; dd > 0; dd--)
	{cad3 += nums[nums.length-dd] }
	if(decimales == true)
	{cad2 += "," + cad3}
	 donde.value = cad2
	}
//donde.focus()  // no hanilitar esto, es una vaina seria
}

function SoloNumero(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8 || tecla == 0 || tecla == 9) return true; //Tecla de retroceso (para poder borrar)
    patron = /\d/;
    //patron = /(^[0-9.]$)/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}