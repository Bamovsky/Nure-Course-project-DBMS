$(document).ready(function(){

$('#getOrder').on('click', function () {
		let data = [];
		for (let i=0; i<$('input[name^=order').length; i++){
			if ($('input[name^=order')[i].value == ""){
		      data.push('1');			
			}
			else {
          data.push($('input[name^=order')[i].value);   
		}
		}
          data=JSON.stringify(data);    
          $.ajax({
          type:'POST',
          url:'../order.php',
          data:{data: data },
          success: function(data){
            $('#result')[0].innerHTML = data;
          }});	


})
});
