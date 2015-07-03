function searchInTable(searchbox){
$('#' + searchbox).on('keyup', function(e) {
    if ('' != this.value) {
        var reg = new RegExp(this.value, 'i'); // case-insesitive

        $('table tbody').find('tr').each(function() {
            var $me = $(this);
            if (!$me.children('td').text().match(reg)) {
                $me.hide();
            } else {
                $me.show();
            }
        });
    } else {
        $('table tbody').find('tr').show();
    }	
});
}

function searchForUsers(searchFor){
$.ajax({
	url: "users.php",
	type: "GET",
	data: {'s':searchFor,'output':'user_admin'},
	success: function(result){
		var tchome = document.getElementById('custUserArea');
		tchome.innerHTML = result;
	}
	});
}

function searchForGroups(searchFor){
$.ajax({
	url: "groups.php",
	type: "GET",
	data: {'s':searchFor},
	success: function(result){
		var tchome = document.getElementById('custGroupArea');
		tchome.innerHTML = result;
	}
	});
}

function searchForGroupTypes(searchFor){
$.ajax({
	url: "groups.php",
	type: "GET",
	data: {'s':searchFor},
	success: function(result){
		var tchome = document.getElementById('custGroupTypeArea');
		tchome.innerHTML = result;
	}
	});
}

function searchForCourses(){

	// get the searchbar text
	// run php file with get set to text
	// get div for user area
	// replace div content

}

function searchForCouresComplete(){
$.ajax({
	url: "courses.php",
	type: "GET",
	data: {'s':searchFor},
	success: function(result){
		var tchome = document.getElementById('custGroupTypeArea');
		tchome.innerHTML = result;
	}
	});
}
