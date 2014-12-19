function scorePassword(pass) {
    var score = 0;
    if (!pass)
        return score;

    // award every unique letter until 5 repetitions
    var letters = new Object();
    for (var i=0; i<pass.length; i++) {
        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
        score += 2.0 / letters[pass[i]];
    }

    // bonus points for mixing it up
    var variations = {
        digits: /\d/.test(pass),
        lower: /[a-z]/.test(pass),
        upper: /[A-Z]/.test(pass),
        nonWords: /\W/.test(pass)
    };

    variationCount = 0;
    for (var check in variations) {
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 20;
	if(score > 50){
		score = 50;
	}
    return parseInt(score);
}

function checkPasswordSame(){
	var pass1 = document.getElementById("regpassword").value;
	var pass2 = document.getElementById("confirmregpassword").value;

	var showmatch = document.getElementById("passwordsmatchspan");
	if(pass1 == pass2){
	showmatch.innerHTML = "Passwords match!";
	showmatch.style = "font-weight:bold; color: #00aa22";
	return true;
	}else{
	showmatch.innerHTML = "Passwords do not match!";
	showmatch.style = "color: #ee0000";
	return false;
	}
}

function checkPasswordStr() {
var pass = document.getElementById("regpassword").value;
var classer = document.getElementById("strength");
    var score = scorePassword(pass);
	classer.innerHTML = score + "/50";
    if (score > 40){
		classer.style = "color: #00ff00";
		return true;
		}
    if (score > 30){

		classer.style = "color: #aaaa11";
		return true;
		}
    if (score < 30){
 
		classer.style = "color: #ee0000";
		return true;
		}
	return false;
}

function gen_random_pass(){
	var randomstring = Math.random().toString(36).slice(-9);
	return randomstring;
}

function hidePasswordArea(){
	var stat = $('#passwordAreaDiv').is(':hidden');
	if(stat){
		$('#passwordAreaDiv').show();
		clearPasswordFields();
	}else
	{
		$('#passwordAreaDiv').hide();
	}
	
}

function clearPasswordFields(){
	var classer = document.getElementById("regpassword");
	var passIs = gen_random_pass();
	classer.value = '';
	classer = document.getElementById("confirmregpassword");
	classer.value = '';
	var showmatch = document.getElementById("passwordsmatchspan");
	showmatch.innerHTML = 'No password entered.';
	var classer = document.getElementById("strength");
	classer.innerHTML = '0/50';
	return true;
}

function genPasswordStr() {
	var classer = document.getElementById("regpassword");
	var passIs = gen_random_pass();
	classer.value = passIs;
	classer = document.getElementById("confirmregpassword");
	classer.value = passIs;
	//classer = document.getElementById("passwordIsGen");
	//classer.innerHTML = "Password: " + "<strong>" + passIs + "</strong>";
	checkPasswordSame();
	return true;
}

function checkEmailTaken(){
	
	var wantEmail = document.getElementById('emailad').value;
	
	$.ajax({
	url: "scripts/js_isEmailTaken.php",
	type: "GET",
	data: {'email':wantEmail},
	success: function(result){
		var tchome = document.getElementById('emailTaken');
		tchome.innerHTML = result;
	}
});
}