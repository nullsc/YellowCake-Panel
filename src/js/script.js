// 
function checkAllBoxes(){
	let boxes = document.querySelectorAll(".log-table input");
	if (boxes[0].checked === true) { //top box sets the action
		for (let i=1; i<boxes.length; i++) { // skip the first one
			boxes[i].checked = true;
		}
	} else {
		for (let i=1; i<boxes.length; i++) {
			boxes[i].checked = false;
		}
	}
}

function selectAllBoxes(elem, action){ //
	/* Select all checkboxes
	element, action must be true or falseeg. true checks all boxes */
	let boxes = document.querySelectorAll(elem);
	if (action === true) {
		for (let i=0; i<boxes.length; i++) {
			boxes[i].checked = true;
		}
	} else {
		for (let i=0; i<boxes.length; i++) {
			boxes[i].checked = false;
		}
	}
}

function closeBanner(elem){
	/* Close the alert/info banner when X is clicked
	eg. onclick closeBanner(this.parentElement.nodeName) */
	let banner = document.querySelector(elem);
	banner.style.display = "none";
}
