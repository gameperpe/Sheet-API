<html>
  <head></head>
  <body>
 
    <script>
    function makeApiCall() {
      var params = {
  
        spreadsheetId: '1ZgQPhaC89JxtB5GkFdMyRmTjIGur6fuXu78HvYpHXSU',  // TODO: Update placeholder value.
 
        range: 'sheet1',  
 
      };
 
      var request = gapi.client.sheets.spreadsheets.values.get(params);
      request.then(function(response) {
        // TODO: Change code below to process the `response` object:
        console.log(response.result);
          populateSheet(response.result);
        }, function(reason) {
          console.error('error: ' + reason.result.error.message);
               });
}
 
    function initClient() {
      var API_KEY = 'AIzaSyCJC5CwlOdqGT9RR_s0AwH0bXD91jJUZeI';  // TODO: Update placeholder with desired API key.
 
      var CLIENT_ID = '172294547564-n9ojahgolvo78i9cp0qvu45edsmks6kb.apps.googleusercontent.com';  // TODO: Update placeholder with desired client ID.
 
      // TODO: Authorize using one of the following scopes:
      //   'https://www.googleapis.com/auth/drive'
      //   'https://www.googleapis.com/auth/drive.file'
      //   'https://www.googleapis.com/auth/drive.readonly'
      //   'https://www.googleapis.com/auth/spreadsheets'
      //   'https://www.googleapis.com/auth/spreadsheets.readonly'
      var SCOPE = 'https://www.googleapis.com/auth/spreadsheets.readonly';
 
      gapi.client.init({
        'apiKey': API_KEY,
        'clientId': CLIENT_ID,
        'scope': SCOPE,
        'discoveryDocs': ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
      }).then(function() {
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSignInStatus);
        updateSignInStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
      });
    }
 
    function handleClientLoad() {
      gapi.load('client:auth2', initClient);
    }
 
    function updateSignInStatus(isSignedIn) {
      if (isSignedIn) {
        makeApiCall();
      }
    }
 
    function handleSignInClick(event) {
      gapi.auth2.getAuthInstance().signIn();
    }
 
    function handleSignOutClick(event) {
      gapi.auth2.getAuthInstance().signOut();
    }
   function populateSheet(result) {
  for(var row=0; row<8; row++) {
  
    for(var col=0; col<4; col++) {
    document.getElementById(row+":"+col).value = result.values[row][col];
      
  }
 
  }
}
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    <button id="signin-button" onclick="handleSignInClick()">Sign in</button>
    <button id="signout-button" onclick="handleSignOutClick()">Sign out</button>
     <div style="margin-left:auto; margin-right:auto; width:960px;">
    <?php
    for($row = 0; $row < 8; $row++) {
      echo "<div style='clear:both'>";
      for($col = 0; $col < 4; $col++) {
        echo "<input type='text' style='float:left;' name = '$row:$col' id='$row:$col'>";
        
      }
      echo "</div>";
     
      
    }
    ?>
  </body>
</html>
