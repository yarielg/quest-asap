(function($){
    
    jQuery(document).ready(function(){
        var test_connection_btn = jQuery('#test_connection_btn');
        


        test_connection_btn.click(function(){
            var result_connection = jQuery('#result_connection');
            var ip_sap = jQuery('#ip_sap').val();
            var port_sap = jQuery('#port_sap').val();
            var key_sap = jQuery('#key_sap').val();
            var ip_real =jQuery('#ip_real_sap').val();

            var url_service = "http://" + ip_sap + ":" + port_sap + "/ItemService.svc/getItems?key=" + key_sap + "&itemcode=ALL&cardcode=ALL&customerpricelist=ALL";
            if(ip_real==ip_sap){
                url_service = "http://" + "192.168.1.11" + ":" + port_sap + "/ItemService.svc/getItems?key=" + key_sap + "&itemcode=ALL&cardcode=ALL&customerpricelist=ALL";
            }
            
            jQuery.ajax({
                url: url_service,
                type: "GET",
                data: {},

            }).done(function (data, textStatus, jqxhr) {
                   
                   result_connection.text('Connection Successuful').css({'color':'green','font-size':'16px','margin-left':'15px'});

            }).fail(function (jqxhr, textStatus, errorThrown) {

                    result_connection.text('No Connection').css({'color':'red','font-size':'16px','margin-left':'15px'});


            });
        });

    });

})(jQuery);

/*

*/