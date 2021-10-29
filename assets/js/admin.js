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
	  	    audio.play();
	  	    audio.addEventListener("ended", function() {location.reload()});
		}
	});
});