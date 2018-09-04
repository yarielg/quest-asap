(function($){
    
    jQuery(document).ready(function(){

        //get sku html element 
        let sku = jQuery('.sku_wrapper .sku');
        var price_list_user =jQuery('#price_list_user');

        //Connection SAP
        var result_connection = jQuery('#result_connection');
        var ip_sap = jQuery('#ip_sap').val();
        var port_sap = jQuery('#port_sap').val();
        var key_sap = jQuery('#key_sap').val();
        var ip_real =jQuery('#ip_real_sap').val();

        //get availability stock container
        let quest_availability_container = jQuery('#quest_availability_container');
        //get price container variation
        let quest_container_price = jQuery('.woocommerce-variation.single_variation');
        //get price simple product
        let quest_container_simple_price = jQuery('.price span.woocommerce-Price-amount.amount');
        //get normal container price
        let pprice = jQuery('.content_product_detail p.price');

        let div_availability = jQuery('#availability_text h5');
       // div_availability.css('display','none');

        //validando stock quantity
        let btn_quantity = jQuery('#quest_check_availability');
        let txt_quantity = jQuery('#quest_availability_text');
        let form_variation = jQuery('.variations_form');
        console.log();


        function get_user_real_price(sku,price_list_user){

            if(price_list_user.attr('user_id')!="0"){
                var url_service = "http://" + ip_sap + ":" + port_sap + "/ItemService.svc/getItems?key=" + key_sap + "&itemcode="+sku+"&cardcode=ALL&customerpricelist="+price_list_user.val();
                if(ip_real==ip_sap){
                    url_service = "http://" + "192.168.1.11" + ":" + port_sap + "/ItemService.svc/getItems?key=" + key_sap + "&itemcode="+sku+"&cardcode=ALL&customerpricelist="+price_list_user.val();
                }

                jQuery.ajax({
                    url: url_service,
                    type: "GET",
                    data: {},
                }).done(function (data, textStatus, jqxhr) {
                    
                        var price = data[0]['CustomerPrice'];
                           if(price!=0){
                             if(form_variation.length>0){
                                quest_container_price.html('<div class="woocommerce-variation-description"></div>'+
                                                       '<div class="woocommerce-variation-price"><span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>'+price.toFixed(2)+'</span></span></div>');
                             }else{
                                quest_container_simple_price.html('$'+price.toFixed(2));
                             }
                           
                        }else{
                            quest_container_price.html('<div class="woocommerce-variation-description"></div>'+
                                                       '<div class="woocommerce-variation-price"><span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"  style="font-size:11px;">CALL FOR PRICE</span></div>');
                        }
                
                }).fail(function (jqxhr, textStatus, errorThrown) {
                       quest_container_price.html('<div class="woocommerce-variation-description"></div>'+
                                                       '<div class="woocommerce-variation-price"><span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"  style="font-size:11px; color:red;">CALL FOR PRICE</span></div>');
                        console.log('sap connection interrupted');
                });
            }else{
                quest_container_price.html('<div class="woocommerce-variation-description"></div>'+
                                                       '<div class="woocommerce-variation-price"><span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol" style="font-size:11px;">Login please!</span></div>');
            }
        }
        
        setTimeout(function(){
          if(quest_container_price.css('display')=='block' || pprice.text()!=""){
            quest_availability_container.css('display','block');
            get_user_real_price(sku.html(),price_list_user);
          }             
        }, 1000);

         //evento que ocurre cuando las variaciones son elegidas
        jQuery('select').blur( function(){
            //pasado un 4 ms muestra availability stock si price container es visible
            setTimeout(function(){

              if(quest_container_price.css('display')=='block'){
                get_user_real_price(sku.html(),price_list_user);
                quest_availability_container.css('display','block');
              }else{
                quest_availability_container.css('display','none');
              }             
            }, 400);
        }); 

        function ajax_check_availability(){
            var url_service = "http://" + ip_sap + ":" + port_sap + "/ItemService.svc/getItems?key=" + key_sap + "&itemcode="+sku.text()+"&cardcode=ALL&customerpricelist=ALL";
            if(ip_real==ip_sap){
                url_service = "http://" + "192.168.1.11" + ":" + port_sap + "/ItemService.svc/getItems?key=" + key_sap + "&itemcode="+sku.text()+"&cardcode=ALL&customerpricelist=ALL";
            }
            
            jQuery.ajax({
                url: url_service,
                type: "GET",
                data: {},

            }).done(function (data, textStatus, jqxhr) {
                   
                   var stock = data[0]['Stock_50'];
                   if(txt_quantity.val()=="" || isNaN(txt_quantity.val())){
                        alert('Error: Enter a numeric value to check availability!');
                    }else {
                        if(parseInt(txt_quantity.val())>stock){
                            div_availability.css('display','block');
                               div_availability.css('color','red');
                            div_availability.text('Call for Availability');
                        }else{
                            div_availability.css('display','block');
                            div_availability.css('color','green');
                            div_availability.text('Available');
                            
                        } 
                    }

            }).fail(function (jqxhr, textStatus, errorThrown) {

                    result_connection.text('No Connection').css({'color':'red','font-size':'16px','margin-left':'15px'});


            });
        }

        //Elimando que al dar enter agregue el producto al shop car
        txt_quantity.keypress(function(event){
            
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                event.preventDefault();
                ajax_check_availability();
            }

        });

        btn_quantity.click(function(){
            
            ajax_check_availability();          
         });

    });

})(jQuery);
