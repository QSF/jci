//$(function(){
$(document).ready(function(){

	$(".checkbox").click(function(event){

    parentId = event.target.value;
    
    if($("#checkbox"+parentId).is(":checked")){
      $.ajax({
      url: "./index.php?controller=field&action=findChildrenJSON",
      type: "GET",
      dataType: "json",
      data: {"field_id": parentId},
      success: function(data){
        var container = $('#children_'+parentId);
        var html = '<div id=cb'+parentId+'>';
        console.log(data);
        for( var key in data){

          var name = data[key];
          console.log(name);
          html += 
            '<label class="checkbox">'+
            '<input type="checkbox" '+ 
            'id="checkbox'+key+'" value="'+key+'" name="actingArea[]"/>'+
              name+
            '</label>';      
        }

          html += '</div>';
          console.log(html);
          container.append($(html));
      },
      error: function(error){
           console.log(error);
      }

      });
    }
    else{
      $("#children_"+parentId).children().remove();
    }  
  });
});
/*		
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
*/
