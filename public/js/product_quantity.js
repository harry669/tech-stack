$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(event){

            event.preventDefault();
         var id= event.target.id;
        var new_id='#quantity'.concat(id);
        var new_qty= 'invisible_quantity'.concat(id);
        
        // Stop acting like a button
        
        // Get the field name
        var quantity = parseInt($(new_id).val());
        console.log(quantity);

        
        
        // If is not undefined
             if(quantity>0 && quantity<5)
              {
                  $(new_id).val(quantity + 1);
                  var qty= $(new_id).val();
                  document.getElementById(new_qty).value=qty;
               }
            

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(event){
           
         event.preventDefault();

          var id= event.target.id;
        var new_id='#quantity'.concat(id);
        var new_qty= 'invisible_quantity'.concat(id);

        // Stop acting like a button
        //e.preventDefault();
        // Get the field name
        var quantity = parseInt($(new_id).val());
        
        // If is not undefined
      
            // Increment
        
            if(quantity>0 && quantity>1){
            $(new_id).val(quantity - 1);
                    
                   var qty= $(new_id).val();
                   document.getElementById(new_qty).value=qty;
            }
    });
    
});