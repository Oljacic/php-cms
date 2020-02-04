$(document).ready(function(){

     $('#selectAllBoxes').click(function(event){
          if(this.checked) {
               $('.checkboxes').each(function(){
                    this.checked = true;
               });
          } else {
               $('.checkboxes').each(function(){
                    this.checked = false;
               });
          }
     });


     var div_box = "<div id='load-screen'><div id='loading'></div></div>";
     $("body").prepend(div_box);
     $('#load-screen').delay(700).fadeOut(600, function() {
          $(this).remove();
     });

     // CK Editor
     ClassicEditor.create(document.querySelector('#body')).catch(error => {
          console.error(error);   
     });
     
});