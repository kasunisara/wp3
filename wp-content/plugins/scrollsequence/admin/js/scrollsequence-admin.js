(function( $ ) {
	'use strict';  

/**
 * Render image numbers in CPT
 *
 * since    updated for 0.8.5
 *
 * 
 *
 *
 */

 

		//console.log('Scrollsequence admin.js initialized');

	
		function renderImageNumbersCarbon() {
			var ssqCmb = {
				pageList:document.getElementsByClassName("cf-media-gallery__inner"),
				imageLists:[],
			}
			
			// Remove any pre-existing image seq number class 
				jQuery("p").remove(".imageSeqNumber");

	 		// AK ROADM Define Notices and Remove any pre-existing 
	 		var notice_toomanyimg = document.getElementById("scrollsequence_notice_toomanyimg"); 
	 			if (notice_toomanyimg) {
    				notice_toomanyimg.style.display = "none";
				}
	 			

	 		var notice_toomanypages = document.getElementById("scrollsequence_notice_toomanypages"); 
	 			if (notice_toomanypages){
	 				notice_toomanypages.style.display = "none";
	 			}
	 			

			if(ssqCmb.pageList.length >2){ // AKROADM FREE
				notice_toomanypages.style.display = "block"; 
				console.log('more than two pages!!!');
			}

	 			//console.log('ahoj tady je PRO ak:',ssqCmb);
			for (var i=0; i< ssqCmb.pageList.length; i++){
				//console.log('1 - page:',i,'has number of images:',ssqCmb.pageList[i].getElementsByClassName("cmb2-media-item").length);
				ssqCmb.imageLists[i]=ssqCmb.pageList[i].getElementsByClassName("cf-media-gallery__item-inner")
				//console.log(ssqCmb.imageLists[i]);

				for (var j=0; j< ssqCmb.imageLists[i].length; j++){

					var cislo = document.createElement("p");   // Create a <p> element
					cislo.classList.add("imageSeqNumber");
					cislo.id="imageSeqId"+[i]+'_'+[j];

					
					if (j < 100){ // AK ROADM
						cislo.innerHTML = j;
						ssqCmb.imageLists[i][j].appendChild(cislo); 
						//console.log('page:',i,'image:',j,'image element OK :',ssqCmb.imageLists[i][j]);
					}
					else{ 
						cislo.innerHTML = 'X';
						ssqCmb.imageLists[i][j].appendChild(cislo); 
						//console.log('page:',i,'image:',j,'image element NOK:',ssqCmb.imageLists[i][j]);
						notice_toomanyimg.style.display = "block"; 

					}

				} // END for loop j 			
			} // END for loop i

			//console.log(ssqCmb);
		} // END function 

	


	// Render Image  every "second"
		window.setInterval(function(){
		  /// call your function here
		  renderImageNumbersCarbon()
		  renderButtonsCarbonNew()

		}, 1000); 
	 renderImageNumbersCarbon() // run immediately 


/**
* NEW VERSION OF BUTTONS THAT ALLOW BULK ACTIONS 
* https://www.javascripttutorial.net/javascript-dom/javascript-select-box/
* Since 1.0.079
*
*/
	// Helper functions 
		function insertAfterButton(referenceNode, newNode) {
		  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
		}

		function reverseChildren(parent) {
		    for (var i = 1; i < parent.childNodes.length; i++){
		        parent.insertBefore(parent.childNodes[i], parent.firstChild);
		    }
		}


	function renderButtonsCarbonNew(){ // TRANSLATION IS MISSING FOR STRINGS BELOW 
		let selectAttsButtonCarbon = document.getElementsByClassName('button cf-media-gallery__browse');
		if (selectAttsButtonCarbon.length > 0) {
		    //console.log('OH YES! OH YES! OH YES! "SELECT ATTACHMENT" BUTTON EXISTS')
			for (let i = 0; i < selectAttsButtonCarbon.length; i++) { // loop through scenes
				let bulkSelectorElement = document.createElement("select");
				bulkSelectorElement.innerHTML = 
				//"<select id='select+"+i+"'>"+
					"<option > - Bulk Actions - </option>"+
					"<option value='sortby-name'>Sort By Name</option>"+
					"<option value='sortby-date'>Sort By Date</option>"+
					"<option value='sortby-reverse'>Reverse Current Order</option>"+
					"<option value='delete-all'>Delete All</option>";
				//"</select>";
				bulkSelectorElement.id="ssqSortBy"+i;
				bulkSelectorElement.style.marginLeft="10px"
				bulkSelectorElement.dataset.cislo=i;		

				bulkSelectorElement.onchange = (event) => {
		            event.preventDefault();
		            let confirmAction
					switch(bulkSelectorElement.value) {
					  case 'sortby-name': //console.log('selection changed to sortby-name')
					    confirmAction = confirm('Are you sure you want to sort images by name?');
					    if (confirmAction) { // console.log('Confirmation - CONFIRMED:', event.target.dataset.cislo)
					    	bulkActionsSortbyName(event.target.dataset.cislo)
					    }
					    break;
					  case 'sortby-date': //console.log('selection changed to sortby-date')
					    confirmAction = confirm('Are you sure you want to sort images by date?');
					    if (confirmAction) { // console.log('Confirmation - CONFIRMED:', event.target.dataset.cislo)
					    	bulkActionsSortbyDate(event.target.dataset.cislo)
					    }
					    break;					    
					  case 'sortby-reverse': //console.log('selection changed to sortby-reverse')
					    confirmAction = confirm('Are you sure you want to reverse images order?');
					    if (confirmAction) { // console.log('Confirmation - CONFIRMED:', event.target.dataset.cislo)
					    	bulkActionsSortReverse(event.target.dataset.cislo)
					    }					  
					    break;
					  case 'delete-all': // console.log('selection changed to delete-all')
					    confirmAction = confirm('Are you sure you want to remove all images from scene?');
					    if (confirmAction) { // console.log('Confirmation - CONFIRMED:', event.target.dataset.cislo)
					    	bulkActionsDeleteAll(event.target.dataset.cislo)
					    }						    
					    break;
					  default: //console.log('selection changed to default value (bulk actions)')
					    
					}
		        };

				// Check if element exists, if not create, if yes do nothing
				let prevEl=document.getElementById("ssqSortBy"+i)
				if (!prevEl){
					insertAfterButton(selectAttsButtonCarbon[i], bulkSelectorElement);
				} else {
					//console.log('do nothing, selector already exists')
				}

			} // loop through scenesend
		} else {
			//console.log('OH NO "SELECT ATTACHMENT" BUTTON IS UNAVAILABE')

		}
	}
	// BULK ACTION FUNCTIONS 
		function bulkActionsSortbyName(sceneNumber){
			let UlAytems=document.getElementsByClassName('cf-media-gallery__list ui-sortable').item(sceneNumber)
			let listAytems= UlAytems.getElementsByTagName("LI");
			//console.log('listAytems:', listAytems);

			jQuery(listAytems).sort(sort_li) // sort elements
			                  .appendTo(document.getElementsByClassName('cf-media-gallery__list ui-sortable').item(sceneNumber)); // append again to the list
			// sort function callback
			function sort_li(a, b){
				//console.log('a:',a,a.children[0].children[1].innerHTML.toLowerCase(),'b',b,b.children[0].children[1].innerHTML.toLowerCase());
			    return (b.children[0].children[1].innerHTML.toLowerCase()) < (a.children[0].children[1].innerHTML.toLowerCase()) ? 1 : -1;    
			}			
		}	

		function bulkActionsSortbyDate(sceneNumber){
			let UlAytems=document.getElementsByClassName('cf-media-gallery__list ui-sortable').item(sceneNumber)
			let listAytems= UlAytems.getElementsByTagName("LI");
			//console.log('listAytems:', listAytems);

			jQuery(listAytems).sort(sort_li) // sort elements
			                  .appendTo(document.getElementsByClassName('cf-media-gallery__list ui-sortable').item(sceneNumber)); // append again to the list
			// sort function callback
			function sort_li(a, b){
				//console.log('a:',a,a.children[1].value.toLowerCase(),'b',b,b.children[1].value.toLowerCase());
			    return (b.children[1].value.toLowerCase()) < (a.children[1].value.toLowerCase()) ? 1 : -1;    
			}			
		}	

		function bulkActionsSortReverse(sceneNumber){
			//console.log('S O R T - R E V E R S E on Scene ',sceneNumber)
			reverseChildren(document.getElementsByClassName('cf-media-gallery__list ui-sortable').item(sceneNumber))
		}
		function bulkActionsDeleteAll(sceneNumber){
			//console.log('D E L E T E - A L L -  on Scene ',sceneNumber)
			var imageUlforIthPage2 = document.getElementsByClassName('cf-media-gallery__list ui-sortable').item(sceneNumber);
			var removeBut2= imageUlforIthPage2.getElementsByClassName("cf-media-gallery__item-remove");
			for (var k = removeBut2.length - 1; k >= 0; k--) {
				removeBut2[k].click() //AKTODO In the future I could change this to delete the variable/element instead of click for every image, except last one. 
			}			
		}	







})( jQuery );
