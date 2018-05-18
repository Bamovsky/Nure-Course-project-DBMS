$(document).ready(function(){
    let cat=$('#cat').children();
    for (let i=0;i<cat.length;i++){
      cat[i].onclick = SelCat;
    }
    let name = " ";
    function SelCat () {
      $.ajax({
          type:'POST',
          url:'../SelectCatagoty.php',
          data:'name='+this.innerText,
          success: function(data){
            $('#product')[0].innerHTML = data;
          }});
    }

});
