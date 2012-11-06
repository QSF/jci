//$(function(){
$(document).ready(function(){

	$(".actingArea").click(function(){
		
			parentId = event.target.value;
			if($("#checkbox"+parentId).is(":checked")){
				var container = $('#childFields');
				var html = '<div id=cb'+parentId+'>';
				for( i in arrayJSONChildren[parentId]){
					var child = arrayJSONChildren[parentId][i]; 
   					html += '<li>'+
   							'<label for="cb'+child.id+'">'+child.name+'</label>'+ 
   							'<input type="checkbox" id="cb'+child.id+'" value="'+child.id+'" />'+
   							'</li>';			
  				}
  				html += '</div>';
  				container.append($(html));
  			}
  			else{
  				$("#cb"+parentId).remove();
  			}
	});
});