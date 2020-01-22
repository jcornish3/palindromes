<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config/config.php';
?>

<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .fa-times {
        color: red
      }
      .fa-check {
        color: green
      }
    </style>
  </head>

  <body>

    <div id=container>

      <div class="col">
        <h2>Palindromes</h2>
      </div>
      <div class="col-8">
        <div class="input-group">
    			<input type="text" id="palindromeInput" class="form-control"
    				required pattern="[A-Za-z0-9][A-Za-z0-9\s]{1,199}"
    				placeholder="enter a value (up to 200 letters or numbers please)" />
    			<span class="input-group-append" id="button-addon4">
            <button id="submit" class="btn btn-outline-secondary" title="Submit">
							Submit
    				</button>
    			</span>
    		</div>
    	</div>

      <div class="col-8">
  			<ul id="palindrome-list" class="list-group">
  			</ul>
      </div>

			<script type="text/template" id="palindrome-template">
        <span>
          <strong><%= value %></strong>
        </span>

        <span class="float-right">
          <% if(palindrome || palindrome == 'true') { %>
            <i class="fa fa-check fa-lg" aria-hidden="true" title="Palindrome"></i>
          <% } else { %>
            <i class="fa fa-times fa-lg" aria-hidden="true" title="Not a Palindrome"></i>
          <% } %>
          <button class="btn btn-primary edit">Edit</button>
          <button class="btn btn-primary delete">Delete</button>
        </span>
			</script>

      <script type="text/template" id="edit-template">
        <div class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
    			       <input type="text" id="editInput" class="form-control" value="<%= value %>"
                    required pattern="[A-Za-z0-9][A-Za-z0-9\s]{1,199}"
                    title="(up to 200 letters or numbers please)"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </script>

    </div>

    <script src="scripts/js/third-party/jquery-3.4.1.min.js"/></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="scripts/js/third-party/bootstrap.min.js"></script>
    <script src="scripts/js/third-party/underscore.js"></script>
    <script src="scripts/js/third-party/backbone.js"></script>

    <script src="scripts/js/main.js"></script>

    <script src="scripts/js/app/model/palindromeModel.js"></script>
    <script src="scripts/js/app/collection/palindromeCollection.js"></script>
    <script src="scripts/js/app/view/palindromeView.js"></script>
    <script src="scripts/js/app/view/palindromeList.js"></script>
    <script src="scripts/js/app/view/palindromeItem.js"></script>
	</body>
</html>
