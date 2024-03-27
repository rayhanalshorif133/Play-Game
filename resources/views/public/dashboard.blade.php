@extends('layouts.app_public')

@section('content')
    <input type="hidden" name="authUser" id="user_id" value="{{$authUser->id}}">
@endsection


{{-- scripts --}}
@push('scripts')
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        initFirebaseMessagingRegistration();
    });

    var firebaseConfig = {
        apiKey: "AIzaSyCkAepUm6AgMLMGKR7Ad9ILf-cbDBJQ9KA",
        authDomain: "push-notifications-9c6b3.firebaseapp.com",
        projectId: "push-notifications-9c6b3",
        storageBucket: "push-notifications-9c6b3.appspot.com",
        messagingSenderId: "270243300047",
        appId: "1:270243300047:web:d773b380f977e146452dba",
        measurementId: "G-SSVX16STS2"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {

               axios.put('/save-auth-user-token',{
                    user_id: $('#user_id').val(),
                    token: token
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
               });


            }).catch(function (err) {
                console.log('Something went wrong while retrieving the token. ', err);
            });
     }

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
</script>
@endpush
