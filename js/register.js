$(document).ready(function() {
  $("#submit").click(function() {
    var values = {
  'uname': document.getElementById('username').value,
  'pass': document.getElementById('password').value,
  'email': document.getElementById('email').value,
  'mobile': document.getElementById('mobile').value,

  'dob': document.getElementById('dob').value,

};

$.ajax({
  url: "php/register.php",
  type: "POST",
  
  data:values,
  success: function(result){
alert(result);
window.location.href = '/login.html';
}
});

  })
});
