<script type="text/javascript">
// when the DOM is ready
$(document).ready(function() {
    // bind some code to the form's onsubmit handler
    $('form[name=theForm]').submit(function() {
        if(formCheck(this)) {
            // $.post makes a POST XHR request, the first parameter takes the form's
            // specified action
            $.post($("form[name=theForm]").attr('action'), function(resp) {
                if(resp == '1') {
                    alert('Your form has been submitted');
                } else {
                    alert('There was a problem submitting your form');
                }
            });
        }
        return false;
    });
});
</script>