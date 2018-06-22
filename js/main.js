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
    
    $("body").on('click',"a[id|='add']", function() {
    id = $(this).attr('id').split('-');
    id = id[1];
    $.get('cart.php?action=add&id=' + id, alert('Product ' + id + ' added'));
});

    $("body").on('click',"#currentOrder", function() {
       $.ajax({
           type:'POST',
           url:'../manager.php',
           data:'',
           success: function(data){
             $('#product')[0].innerHTML = data;
           }});
});

    $("body").on('click',"#historyOrder", function() {
       $.ajax({
           type:'POST',
           url:'../managerH.php',
           data:'',
           success: function(data){
             $('#product')[0].innerHTML = data;
           }});
});    

    $("body").on('click',"[id ^= complete]", function() {
           let id = $(this).attr('id').split('-');
           id = id[1];
           $.ajax({
           type:'POST',
           url:'../manager.php',
           data:{manager : id},
           success: function(data){
             $('#product')[0].innerHTML = data;
           }});
});

    $("body").on('click',"[id=change]", function() {
          let data= {};
          data.Name = $('#applicationName')[0].value;
          data.LastName = $('#applicationLastName')[0].value;
          data.MiddleName = $('#applicationMiddleName')[0].value;
          data.cart = $('#applicationCart')[0].value;
          data.phone = $('#applicationTelephone')[0].value;      
          data.addr = $('#applicationAddr')[0].value;    
          data=JSON.stringify(data); 
          console.log (data); 
           $.ajax({
           type:'POST',
           url:'../settings.php',
           data: {data: data},
           success: function(data){
             $('#product')[0].innerHTML = data;
           }});
});    

    $('#search').on("keyup", function(){ 
          if(event.keyCode==13){ 
          $.ajax({
          type:'POST',
          url:'../search.php',
          data:'search='+this.value,
          success: function(data){
            $('#product')[0].innerHTML = data;
          }});
        }
    });

        $('#map')[0].onclick = function (){
          $.ajax({
          type:'POST',
          url:'../map.php',
          data:'',
          success: function(data){
            $('#product')[0].innerHTML = data;
          }});
      };

        

      $("body").on('click',"#settings", function() {
          $.ajax({
          type:'POST',
          url:'../settings.php',
          data:'',
          success: function(data){
            $('#product')[0].innerHTML = data;
          }});
});    

      $('input[name=sort')[0].onclick = function (){
          $.ajax({
          type:'POST',
          url:'../SelectCatagoty.php',
          data:'sort=DESC',
          success: function(data){
            $('#product')[0].innerHTML = data;
          }});
      };
    
          $('input[name=sort')[1].onclick = function (){
          $.ajax({
          type:'POST',
          url:'../SelectCatagoty.php',
          data:'sort=ASC',
          success: function(data){
            $('#product')[0].innerHTML = data;
          }});
      };


      $("body").on('click',"#manager", function() {
          $.ajax({
          type:'POST',
          url:'../manager.php',
          data:'',
          success: function(data){
            $('#product')[0].innerHTML = data;
          }});
});    

});
