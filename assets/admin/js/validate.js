var ok=0;
function check_post_title()
{
 var f_val=$("#post_title").val();
 if(f_val=="")
 {
  $("#post_title").css({"border":"1px solid red"});
  $("#post_title_error").text("Please enter post title!");
  $("#post_title_error").css({"margin-top":"5px"});
 }
 else
 {
  $("#post_title").css({"border":"1px solid grey"});
  $("#post_title_error").text("");
  $("#post_title_error").css({"margin-top":"0px"});
  ok++;
 }
}

function check_post_content()
{
 var l_val=$("#post_content").val();
 if(l_val=="")
 {
  $("#post_content").css({"border":"1px solid red"});
  $("#post_content_error").text("Don't forget to fill in some content!");
  $("#post_content_error").css({"margin-top":"5px"});
 }
 else
 {
  $("#post_content").css({"border":"1px solid grey"});
  $("#post_content_error").text("");
  $("#post_content_error").css({"margin-top":"0px"});
  ok++;
 }
}

function check_form()
{
 if(ok==2)
 {
  return true;
 }
 else
 {
  alert("Error! Check All The Fields");
  return false;
 }
}