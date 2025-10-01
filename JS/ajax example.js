//Upload the profile img
$("#pic_form").on('submit', function(e) {
  e.preventDefault();

  $(".error-msg").empty();
  $(".error-msg").slideUp();
  $('#loading').show();

  var process_path = "<?php echo get_template_directory_uri(); ?>/ajax/profile_pic.php";
	var file      = $("#pic_input")[0].files[0];
	var imagefile = file.type;
	var match     = ["image/jpeg", "image/png", "image/jpg"];

  if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
    $(".error-msg").html("Please Select A valid Image File <span id='error_message'> Only jpeg, jpg and png Images type allowed </span>");
    $(".error-msg").slideDown();
    alert("Please select a valid image File, and Try again.");
    return false;
  } else {
      $.ajax({
					url: process_path, // Url to which the request is send
					type: "POST", // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false, // The content type used when sending data to the server.
					cache: false, // To unable request pages to be cached
					processData: false, // To send DOMDocument or non processed data file it is set to false
          success: function(data) {
            console.log("ajax success function");
            $('#loading').hide();
            $(".error-msg").html(data);
            $(".error-msg").slideDown();
            alert(data);

            //if data is pic id
            if(1 == 2){
            	$("#pic_input_uid").val(data); 
            } else {
            	console.log("Response: "+data);
            }
          },
          error: function(err) {
            console.log("ajax error function");
            $(".error-msg").html(err);
            $(".error-msg").slideDown();
          },
          complete: function(done) {
            console.log("ajax complete afterparty");
          }
      });
  }

}); //img upload end