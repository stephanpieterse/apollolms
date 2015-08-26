    <script type="text/javascript">
      var CLIENT_ID = '<YOUR_CLIENT_ID>';
      var SCOPES = [
          'https://www.googleapis.com/auth/drive.file',
          'email',
          'profile',
          // Add other scopes needed by your application.
        ];

      /**
       * Called when the client library is loaded.
       */
      function handleClientLoad() {
        checkAuth();
      }

      /**
       * Check if the current user has authorized the application.
       */
      function checkAuth() {
        gapi.auth.authorize(
            {'client_id': CLIENT_ID, 'scope': SCOPES, 'immediate': true},
            handleAuthResult);
      }

      /**
       * Called when authorization server replies.
       *
       * @param {Object} authResult Authorization result.
       */
      function handleAuthResult(authResult) {
        if (authResult) {
          // Access token has been successfully retrieved, requests can be sent to the API
        } else {
          // No access token could be retrieved, force the authorization flow.
          gapi.auth.authorize(
              {'client_id': CLIENT_ID, 'scope': SCOPES, 'immediate': false},
              handleAuthResult);
        }
      }
    </script>
    <script type="text/javascript" src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>

    <script type="text/javascript">
     /**
     * Load the Drive API client.
     * @param {Function} callback Function to call when the client is loaded.
     */
    function loadClient(callback) {
      gapi.client.load('drive', 'v2', callback);
    }
    </script>

    <!-- YOUR CONTENT -->
