let isFirstCall = true;

document.addEventListener("DOMContentLoaded", () => {
	firebase.database().ref('NewOrders').on('value', (snapshot) => {
		if (isFirstCall){
			isFirstCall = false;
		}
		else{
			const data = snapshot.val();
		    var audio = new Audio();
	  	    audio.src = '/assets/sounds/notification.mp3';
	  	    setTimeout(() => {alert("У вас новый заказ");}, 2000);
	  	    try{
	  	    	audio.play();
	  	    }
	  	    catch (error){
	  	    	alert("У вас новый заказ");
	  	    }
		}
	});
});