var pswpElement = document.querySelectorAll('.pswp')[0];
var items,allItems;
var size=localStorage.getItem('size'); // size of the thumbnails
if(!size) size=120;
jQuery("#size").val(size);
jQuery.ajax({
	url:"ajax.php?path="+encodeURIComponent(path),
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
function updateSize(){
	size=jQuery("#size").val();
	localStorage.setItem('size',size);
	loadGallery();
}

function loadGallery(){
	jQuery(".container").empty();
	jQuery(".glyphicon").hide(500);
	if(!items || items.length==0){
		jQuery(".container").append('<div class="empty">Whoops. No images were found. Please check your config.php and set a directory that contains your library.</div>');		
	}
	items=[];
	for(var i=0;i<allItems.length;i++){
		var href;
		if(allItems[i].folder){
			href=allItems[i].href;
		}
		else{
			items.push(allItems[i]);
			href="javascript:openImage("+(items.length-1)+")";
		}
		jQuery(".container").append('<div style="width:'+size+'px;height:'+(parseInt(size)+27)+'px;"><a href="'+href+'"><img  style="width:'+size+'px;height:'+size+'px;" src="'+allItems[i].thumb+'"><br>'+allItems[i].title+'</a></div>');
	}

}

/*
function filterRating(rating){
	items=[];
	for(var i=0;i<allItems.length;i++){
		if(allItems[i].folder || allItems[i].meta.rating>=rating){
			items.push(allItems[i]);
		}
	}
	loadGallery();
}
*/

function openImage(pos){
	var options = {
		index: Number(pos),
		closeOnScroll: false,
		mouseUsed: true,
		history: true,
	};
	// Initializes and opens PhotoSwipe
	var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
	
	gallery.listen('gettingData', function(index,item) {
		if(!item.w){
			jQuery.ajax({
			url:item.size,
			async: false,
			dataType:'json',
			success: function(result){
				item.w=result[0];
				item.h=result[1];
			}
			});
		}
		console.log(item);
    });
	gallery.init();
	
}

