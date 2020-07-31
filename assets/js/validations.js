function formValidation()
{
  var fname=document.getElementById('fname');
  var lname=document.getElementById('lname');
  var mobile=document.getElementById('mobile');
  var email=document.getElementById('email');
  var letters =/^[A-Za-z]$/;

  if (fname.value.length == 0 )
  {
  document.getElementById('namevalidate').innerText = "*FirstName is mandatory";
  fname.focus();
  }
  if(fname.value.match(letters))
  {
    fname.style.background-color="light green";
    document.getElementById('namevalidate').innerText=" ";
  }
  else
  {
    fname.style.border="solid red";
    document.getElementById('namevalidate').innerText = "Should contain only letters";
  }
}
