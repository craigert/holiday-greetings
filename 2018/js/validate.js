// validate and process form
$(document).ready(function () {
	
	// Sets max input for custom greeting
	var max = 3600;
    $('#customGreetings').keydown(function( e ) {
        if (e.which < 0x20) {
            // e.which < 0x20, then it's not a printable character
            // e.which === 0 - Not a character
            return;     // Do nothing
        }
		
		var greetingLength = $.trim($('#customGreetings').html()).length;
		
        if (greetingLength > max) {
            e.preventDefault();
        }
    });

	// Submit button event handler
	$(".frmSubmit").click(function() {
		
		// Recipient informatiom
		var emailArray = $("textarea#emailRecipients").val().split(",");
		
		var customGreetings = $("div#customGreetings").html();
		
		// Set value of hidden textarea to customGreetings for PHP Post
		$("textarea#customMessage").val(customGreetings);
		var customMessage = $("textarea#customMessage").text();
		
		if (confirm("Are you sure you want to send this holiday greetings?")){
			// On submit disable the submit button
			submitState = document.getElementById("Send");
			submitState.value = "Please Wait";
		
			$('#loading_image').css('display','block');
			
			document.eventForm.submit();
		}
		else {
			return false;
		}
		
	});
});