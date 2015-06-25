function searchInA(text){
	
	return true;
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
