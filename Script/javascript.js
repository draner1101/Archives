//Fait par Cédric Paquette
function calcAge(dateString) {				
	return ~~(dateString / 365.25);
};

function calcPied(centimetre) {
	var x = centimetre * 0.032808;
	var pied = x.toString();
	var pi = pied.substring(0,pied.indexOf("."));
	var po = parseFloat(pied.substring(pied.indexOf(".")));
	po = po * 12;
	po = Math.round(po * 1) / 1;
	var str = pi + "’" + po.toString() + "’’";
	
	return (str);
}

function calcPoid(lb) {
	var x = 1.23;
	x = lb / 2.2046;
	return (Math.round(x * 10) / 10);
}

function showhide(){
		if (document.getElementById('grandeur').checked) {
			document.getElementById('txtcm').style.display = 'block';
			document.getElementById('txtpi').style.display = 'none';
		} else {
			document.getElementById('txtpi').style.display = 'block';
			document.getElementById('txtcm').style.display = 'none';
		}
	};

function fetch_position(val,val2,val3)
{
	var f = "id_position";
if(val2==0){
	f=f + "";
} else{
	f=f+val2;
}
	
   $.ajax({
     type: 'post',
     url: 'position.php',
     data: {
       get_option:val,
       get_option2:val3
     },
     success: function (response) {
       document.getElementById(f).innerHTML=response; 
     }
   });
}

function fetch_equipe(val)
{

   $.ajax({
     type: 'post',
     url: 'equipe.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("equipe").innerHTML=response; 
     }
   });
}