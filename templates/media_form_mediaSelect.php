<script type="text/javascript">
	function post_value(){
		//opener.document.resdetails.resource_url.value = document.selector.fileurl.value;
		//window.parent.opener.document.resdetails.resource_url.value = window.document.selectFor.fileurl.value;
		if (window.opener)
		{
		window.opener.returnValue = window.document.getElementById('fileurl').value;
		}	
		window.returnValue = window.document.getElementById('fileurl').value;
		self.close();
		
	}
</script>
<?php

	include("media_form_admin_viewAllMedia.php");

?>
