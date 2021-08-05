document.addEventListener("DOMContentLoaded", () => {
	firebase.database().ref('NewOrders').on('value', (snapshot) => {
	  const data = snapshot.val();
	  var audio = new Audio();
  	  audio.src = '/assets/sounds/notification.mp3';
  	  audio.play();
  	  audio.addEventListener("ended", function() {alert('Новый заказ, обновите страницу заказов');});
	});
});