function showOptions(buttonId) {
	var optionsList = document.getElementById(buttonId).children[0];
	if(optionsList.style.visibility == 'visible') {
		optionsList.style.visibility = 'hidden';
		return;
	} else {
		closeActiveLists();
		optionsList.style.visibility = 'visible';
	}
}

function closeActiveLists() {
	var lists = document.getElementsByClassName("options_list");
	//foreach!!
	for(var i = 0; i < lists.length; i++) {
		if(lists[i].style.visibility == 'visible') {
			lists[i].style.visibility = 'hidden';
		}
	}
}