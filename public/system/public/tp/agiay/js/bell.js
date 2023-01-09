/**
 * Created by mienle on 11/7/17.
 */

window.addEventListener('load',function(e){
//		e.preventDefault();
//        Notification.requestPermission();
    if(!window.Notification){
        alert('Not supported');
    }else{
        Notification.requestPermission().then(function(p){
            if(p=='denied'){
//					alert('Không cho phép thông báo');
            }else if(p=='granted'){
//					alert('Cho phép thông báo');
            }
        });
    }
});
var config = {
    apiKey: "AIzaSyCgXvYT_lrPnds6w6wZjNAPdikbdNXJEQU",
    authDomain: "agiay-e5b9e.firebaseapp.com",
    databaseURL: "agiay-e5b9e.firebaseio.com",
    storageBucket: "agiay-e5b9e.appspot.com",
    messagingSenderId: "",
};
firebase.initializeApp(config);

var database = firebase.database().ref().child("bells");

database.on('child_added', function(data) {
    if(Notification.permission!=='default'){
        var notify;
        notify = new Notification(data.val().title,{
            'body': data.val().content,
            'icon': data.val().image,
            'image': data.val().image,
            'tag': data.getKey(),
        });
        notify.onclick = function(){
            window.open(data.val().url)
        }
    }
//		else{
//			alert('Please allow the notification first');
//		}
});