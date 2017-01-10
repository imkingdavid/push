const messaging = firebase.messaging();

// Perhaps move this into an onclick on a button
// so that permission is only requested when the user wants to
// enable it, not just when they view the site for the first time
messaging.requestPermission()
  .then(function() {
    console.log('Notification permission granted.');
    return messaging.getToken();
  })
  .then(function(token) {
    console.log(token);
    // Send an AJAX call to the controller
    // to add the user_id and this token
    // This way when the user needs to be notified
    // we just gather all of the tokens associated with this user's id
    // and send it
    $.post(firebase_user_url, {
      "user_id": firebase_phpbb_user_id,
      "firebase_token": token
    }).success(function(data){
      console.log(data);
    });
  })
  .catch(function(err) {
    console.log('Unable to get permission to notify.', err);
  });

messaging.onMessage(function(payload) {
  // If the user is already on the page
  // don't display a traditional notification
  // do something else, maybe?
  console.log('onMessage', payload);
});