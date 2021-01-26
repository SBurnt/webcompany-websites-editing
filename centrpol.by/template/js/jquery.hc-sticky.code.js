		  function execute(settings) {
			  $('.flow').hcSticky(settings);
		  }
	  // if page called directly
		jQuery(document).ready(function($){
			if (top === self) {
				execute({top: 0});
			}
		});