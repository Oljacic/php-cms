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


     // CK Editor
     ClassicEditor.create(document.querySelector('#body')).catch(error => {
          console.error(error);   
     });
     
});