$(document).ready(function() {
  $("#submit").click(function() {
    var values = {
  'uname': document.getElementById('username').value,
  'pass': document.getElementById('password').value,


};

$.ajax({
  url: "php/login.php",
  type: "POST",
  
  data:values,
  success: function(result){
if(result){

  if(result ==  document.getElementById('username').value)
  {window.localStorage.setItem("user",result);
  window.location.href = '/profile.html';
 }
 else {
  
  window.location.href = '/';
 }
} else {
 alert("Incorrect Password");
}

}
});

  })
});
