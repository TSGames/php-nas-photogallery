var pswpElement = document.querySelectorAll('.pswp')[0];
var items,allItems;
jQuery.ajax({
	url:"ajax.php?path="+path,
	dataType:'json',
	success: function(result){
		items=result;
		allItems=result;
			var options = {
				index: 0 // start at first slide
			};
			// Initializes and opens PhotoSwipe
			loadGallery();
		}
	
	});
	
function loadGallery(){
	jQuery(".container").empty();
	jQuery(".glyphicon").hide(500);
	for(var i=0;i<items.length;i++){
		var href="javascript:openImage('"+i+"')";
		if(items[i].folder){
			href=items[i].href;
		}
		jQuery(".container").append('<div><a href="'+href+'"><img src="'+items[i].thumb+'"><br>'+items[i].title+'</a></div>');
	}

}

function filterRating(rating){
	items=[];
	for(var i=0;i<allItems.length;i++){
		if(allItems[i].folder || allItems[i].meta.rating>=rating){
			items.push(allItems[i]);
		}
	}
	loadGallery();
}

function openImage(pos){
	var options = {
		index: Number(pos), // start at first slide
		closeOnScroll: false,
		mouseUsed: true,
		history: true,
	};
	// Initializes and opens PhotoSwipe
	var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
	gallery.init();

}

