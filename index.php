
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script>
    var countryUserGEO;
    $(document).ready(function(){

      //get ads sell online by country
      function get_sellads_online_country(country){
        $.ajax({
          url: 'https://www.mexabtc.mx/includes/get-ads.php',
          type: 'get',
          data: {
            country: country,
            typeads: 3
          },
          success: function(response){
        
            var myArray = JSON.parse(response);
            var mensaje = "<tr><th>Buyer</th><th>Payment method</th><th class=\"header-price\" >Price / BTC</th><th class=\"header-limit\" title='Trade amount in fiat currency'>Limits</th><th></th></tr>";
            var c = 0;
            var paymentTradeMethod = "";
            if(myArray.length > 0){
              while (c < myArray.length){

                switch(myArray[c].payment_method){
                  case "CASH_DEPOSIT":
                    paymentTradeMethod = "Cash Deposit";
                    break;
                  case "NATIONAL_BANK":
                  paymentTradeMethod = "National bank transfer";
                    break;
                }

                mensaje += "<tr><td class=\"column-user\"><a href=\"/accounts/profile/" + myArray[c].user_id + "/\"> " + myArray[c].trader_username + " (" + myArray[c].trader_tradescount + "+; " + myArray[c].trader_feedback_score + "%)</a></td><td><a href=\"/buy-bitcoins-online/mx/mexico/cash-deposit/\">" + paymentTradeMethod +":</a>" + myArray[c].branch_name + "</td><td class=\"price-green\">" + myArray[c].price_ad + " " + myArray[c].currency + "</td><td class=\"column-limit\">" + myArray[c].min_transaction_limit + " - " + myArray[c].max_transaction_limit + " " + myArray[c].currency + "</td><td class=\"column-button\"> <a class=\"btn btn-default megabutton\" href=\"" + myArray[c].url_ad + "\"> Sell</a></td></tr>";

                c++;
              }
            }

            document.getElementById("table-sell-online-country").innerHTML = mensaje;

          }

        });
    }

      //get ads buy online by country
      function get_ads_country(country){
        $.ajax({
          url: 'https://www.mexabtc.mx/includes/get-ads.php',
          type: 'get',
          data: {
            country: country,
            typeads: 2
          },
          success: function(response){
         
            var myArray = JSON.parse(response);
            var mensaje = "<tr><th>Seller</th><th>Payment method</th><th class=\"header-price\" >Price / BTC</th><th class=\"header-limit\" title='Trade amount in fiat currency'>Limits</th><th></th></tr>";
            var c = 0;
            var paymentTradeMethod = "";
            if(myArray.length > 0){
              while (c < myArray.length){

                switch(myArray[c].payment_method){
                  case "CASH_DEPOSIT":
                    paymentTradeMethod = "Cash Deposit";
                    break;
                  case "NATIONAL_BANK":
                  paymentTradeMethod = "National bank transfer";
                    break;
                }

                mensaje += "<tr><td class=\"column-user\"><a href=\"/accounts/profile/" + myArray[c].user_id + "/\"> " + myArray[c].trader_username + " (" + myArray[c].trader_tradescount + "+; " + myArray[c].trader_feedback_score + "%)</a></td><td><a href=\"/buy-bitcoins-online/mx/mexico/cash-deposit/\">" + paymentTradeMethod +":</a>" + myArray[c].branch_name + "</td><td class=\"price-green\">" + myArray[c].price_ad + " " + myArray[c].currency + "</td><td class=\"column-limit\">" + myArray[c].min_transaction_limit + " - " + myArray[c].max_transaction_limit + " " + myArray[c].currency + "</td><td class=\"column-button\"> <a class=\"btn btn-default megabutton\" href=\"" + myArray[c].url_ad + "\"> Buy</a></td></tr>";

                c++;
              }
            }

            document.getElementById("table-buy-online-country").innerHTML = mensaje;

          }

        });
    }

//get ads sell local by city
      function get_ads_local_sell(location){
        $.ajax({
          url: 'https://www.mexabtc.mx/includes/get-ads.php',
          type: 'get',
          data: {
            location: location,
            typeads: 1
          },
          success: function(response){
         
            var myArray = JSON.parse(response);
            var mensaje = "<tr><th style=\"width:200px;\">Buyer</th><th class=\"header-distance\" title=\'Your distance from the Trader\'>Distance</th><th title=\'Location\' style=\"width:400px;\">Location</th><th class=\"header-price\" title='Current price of this ad'>Price/BTC</th><th class=\"header-limit\" title='Trade amount in fiat currency'>Limits</th><th>&nbsp;</th></tr>";
            var c = 0;
            var paymentTradeMethod = "";
            if(myArray.length > 0){
              while (c < myArray.length){

                switch(myArray[c].payment_method){
                  case "CASH_DEPOSIT":
                    paymentTradeMethod = "Cash Deposit";
                    break;
                  case "NATIONAL_BANK":
                  paymentTradeMethod = "National bank transfer";
                    break;
                }

                mensaje += "<tr class=\"listing-row\"><td class=\"column-user\"><a href=\"/accounts/profile/" + myArray[c].user_id + "/\">" + myArray[c].trader_username + " (" + myArray[c].trader_tradescount + "+; " + myArray[c].trader_feedback_score + "%)</a></td><td class=\"column-distance\">4.5 km</td><td class=\"column-location\">" + myArray[c].location_ad + "</td><td class=\"price-green\">" + myArray[c].price_ad + " " + myArray[c].currency + "</td><td class=\"column-limit\">" + myArray[c].min_transaction_limit + " - " + myArray[c].max_transaction_limit + " " + myArray[c].currency + "</td><td class=\"column-button\"><a class=\"btn btn-default megabutton\" href=\"" + myArray[c].url_ad + "\">Sell</a></td></tr>";

                c++;
              }
            }

            document.getElementById("table-sell-local-city").innerHTML = mensaje;

          }

        });
    }

//get ads buy local 
      function get_ads_local_buy(location){
        $.ajax({
          url: 'https://www.mexabtc.mx/includes/get-ads.php',
          type: 'get',
          data: {
            location: location,
            typeads: 0
          },
          success: function(response){
         
            var myArray = JSON.parse(response);
            var mensaje = "<tr><th style=\"width:200px;\">Seller</th><th class=\"header-distance\" title=\'Your distance from the Trader\'>Distance</th><th title=\'Location\' style=\"width:400px;\">Location</th><th class=\"header-price\" title='Current price of this ad'>Price/BTC</th><th class=\"header-limit\" title='Trade amount in fiat currency'>Limits</th><th>&nbsp;</th></tr>";
            var c = 0;
            var paymentTradeMethod = "";
            if(myArray.length > 0){
              while (c < myArray.length){

                switch(myArray[c].payment_method){
                  case "CASH_DEPOSIT":
                    paymentTradeMethod = "Cash Deposit";
                    break;
                  case "NATIONAL_BANK":
                  paymentTradeMethod = "National bank transfer";
                    break;
                }

                mensaje += "<tr class=\"listing-row\"><td class=\"column-user\"><a href=\"/accounts/profile/" + myArray[c].user_id + "/\">" + myArray[c].trader_username + " (" + myArray[c].trader_tradescount + "+; " + myArray[c].trader_feedback_score + "%)</a></td><td class=\"column-distance\">4.5 km</td><td class=\"column-location\">" + myArray[c].location_ad + "</td><td class=\"price-green\">" + myArray[c].price_ad + " " + myArray[c].currency + "</td><td class=\"column-limit\">" + myArray[c].min_transaction_limit + " - " + myArray[c].max_transaction_limit + " " + myArray[c].currency + "</td><td class=\"column-button\"><a class=\"btn btn-default megabutton\" href=\"" + myArray[c].url_ad + "\">Buy</a></td></tr>";

                c++;
              }
            }

            document.getElementById("table-buy-local-city").innerHTML = mensaje;

          }

        });
    }


  
  function geocodeLatLng(geocoder,posicion) {
 
  var latlng = {lat: parseFloat(posicion.coords.latitude), lng: parseFloat(posicion.coords.longitude)};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[1]) {
       var cityUserGEO = results[3].formatted_address;
      //var coloniaUserGEO = results[4].formatted_address;
        var estadoUserGEO = results[5].formatted_address;
       //var countryUserGEO = results[7].formatted_address;
       
      countryUserGEO = cityUserGEO.split(",");
      var tamanoLocation = countryUserGEO.length;
      cityUserGEO = countryUserGEO[0];
      countryUserGEO = countryUserGEO[tamanoLocation-1];
       document.getElementById("buy-online-country-span").innerHTML = countryUserGEO;
       document.getElementById("buy-cash-city-span").innerHTML = estadoUserGEO;
       document.getElementById("sell-online-country-span").innerHTML = countryUserGEO;
       document.getElementById("sell-cash-city-span").innerHTML = estadoUserGEO;

       get_ads_country(countryUserGEO);
       get_ads_local_buy(estadoUserGEO);
       get_sellads_online_country(countryUserGEO);
       get_ads_local_sell(estadoUserGEO);
        
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}

function stringCount(haystack, needle) {
    if (!needle || !haystack) {
        return false;
    }
    else {
        var words = haystack.split(needle),
            count = {};
        for (var i = 0, len = words.length; i < len; i++) {
            if (count.hasOwnProperty(words[i])) {
                count[words[i]] = parseInt(count[words[i]], 10) + 1;
            }
            else {
                count[words[i]] = 1;
            }
        }
        return count;
    }
}

navigator.geolocation.getCurrentPosition(function(posicion){
      var geocoder = new google.maps.Geocoder;
      geocodeLatLng(geocoder,posicion);
      
    }, function(error){
      console.log(error);
    });


});




    

    </script>
