<?php 

      $qsap_ip = get_option('qsap_ip');
      $qsap_port = get_option('qsap_port');
      $qsap_key = get_option('qsap_key');

      echo "<h3 class='text-center mt-3'>Customer Price Lists</h3>";

      $url = "http://$qsap_ip:$qsap_port/ItemService.svc/getItems?key=$qsap_key&itemcode=ALL&cardcode=ALL&customerpricelist=ALL";
      
      $file_headers = @get_headers($url);
      if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
           echo '</ul>Connection Error, please test the connection <a href="admin.php?page=main-menu">HERE</a>'; 
      }else{
           $json = file_get_contents($url);
            $json = (array) json_decode($json); //Array de array std

            echo '<ul class="list-group">';
            $price_lists= array();

            foreach ($json as $product) {
                  $product = (array)$product;
                      if(!in_array($product['CustomerPriceList'], $price_lists) && $product['Company'] == 'QUEST TECHNOLOGY'){
                        array_push($price_lists, $product['CustomerPriceList']);
                         echo '<li class="list-group-item">'. $product['CustomerPriceList'] .'</li>';
                      }  
            }

            echo '</ul>';

      }
      
