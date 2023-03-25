$(document).ready(function() {
    $('#fetch-btn').click(function() {
     
      $.ajax({
        url: 'profile.php',
        method: 'POST',
        data: { 
          uname: $('#uname').val(), 
          pass: $('#pass').val(),
          email: $('#email').val(),
          mobile: $('#mobile').val(),
          dob: $('#dob').val() 
        },
        success: function(data) {
          var response = JSON.parse(data);
          if (response.success) {
            $('#uname').html(response.data.uname);
            $('#pass').html(response.data.pass);
            $('#email').html(response.data.email);
            $('#mobile').html(response.data.mobile);
            $('#dob').html(response.data.dob);
          } else {
            $('#error-msg').html(response.message);
          }
        },
        error: function() {
          $('#error-msg').html('An error occurred ');
        }
      });
    });
  });
   