<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <title>Memory</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <table id="tapis">
    <tr>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
    </tr>
    <tr>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
    </tr>
    <tr>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
    </tr>
    <tr>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
        <td><img src="images/Point_d_interrogation.jpg"/></td>
    </tr>
    </table>
<script>

var motifsCartes=[1,1,2,2,3,3,4,4,5,5,6,6];

var etatsCartes=[0,0,0,0,0,0,0,0,0,0,0,0]; 

var cartesRetournees=[];


var nbPairesTrouvees=0;


var imgCartes=document.getElementById("tapis").getElementsByTagName("img");		

for(var i=0;i<imgCartes.length;i++){
	imgCartes[i].noCarte=i; //Ajout de la propriété noCarte à l'objet img
	imgCartes[i].onclick=function(){
		controleJeu(this.noCarte);
	}                      
}


initialiseJeu();

function majAffichage(noCarte){
	switch(etatsCartes[noCarte]){
		case 0:
			imgCartes[noCarte].src="images/Point_d_interrogation.jpg";
			break;
		case 1:
			imgCartes[noCarte].src= "images/"+motifsCartes[noCarte]+".png";
			break;
		case -1:
			imgCartes[noCarte].style.visibility="hidden";
			break;
	}
}


function rejouer(){
	alert("Bravo !");
	location.reload();
}

function initialiseJeu(){
	for(var position=motifsCartes.length-1; position>=1; position--){
		var hasard=Math.floor(Math.random()*(position+1));
		var sauve=motifsCartes[position];
		motifsCartes[position]=motifsCartes[hasard];
		motifsCartes[hasard]=sauve;
	}
}

function controleJeu(noCarte){

	if(cartesRetournees.length<2){

		if(etatsCartes[noCarte]==0){
			etatsCartes[noCarte]=1;
			cartesRetournees.push(noCarte);
			majAffichage(noCarte);
		}

		if(cartesRetournees.length==2){
			var nouveauEtat=0;
			if(motifsCartes[cartesRetournees[0]]==motifsCartes[cartesRetournees[1]]){
				nouveauEtat=-1;
				nbPairesTrouvees++;
			}

			etatsCartes[cartesRetournees[0]]=nouveauEtat;
			etatsCartes[cartesRetournees[1]]=nouveauEtat;

			setTimeout(function(){
				majAffichage(cartesRetournees[0]);
				majAffichage(cartesRetournees[1]);
				cartesRetournees=[];
				if(nbPairesTrouvees==12){
					rejouer();
				}
			},750);
		}
	}
}
</script>
</body>
</html>