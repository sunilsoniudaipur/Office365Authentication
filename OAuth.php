
<?php


     function getRefreshToken($rToken){

            $codeMain=$code;

            $graphId = 'https://graph.microsoft.com/';        // Information about the resource we need access for which in this case is graph.
            $protectedResourceHostName = 'graph.windows.net';
            $graphPrincipalId = $graphId;

            $clientPrincipalId = '<ClientId>';        // Information about the app
            $clientSecret ='<ClientSecret>';

            // Construct the body for the STS request
            $authenticationRequestBody = 'grant_type=refresh_token&client_secret='.$clientSecret
                      .'&'.'resource='.$graphPrincipalId.'&'.'client_id='.$clientPrincipalId.'&refresh_token='.$rToken.'&redirect_uri=<URL>';

            //Using curl to post the information to STS and get back the authentication response
            $ch = curl_init();
            // set url
            $stsUrl = 'https://login.windows.net/advaiya.com/oauth2/token?api-version=1.0';

            curl_setopt($ch, CURLOPT_URL, $stsUrl);
            // Get the response back as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // Mark as Post request
            curl_setopt($ch, CURLOPT_POST, 1);
            // Set the parameters for the request
            curl_setopt($ch, CURLOPT_POSTFIELDS,  $authenticationRequestBody);

            // By default, HTTPS does not work with curl.
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // read the output from the post request
            $output = curl_exec($ch);
            // close curl resource to free up system resources

            curl_close($ch);
            // decode the response from sts using json decoder
            $tokenOutput = json_decode($output);

            return $tokenOutput;
        }

        function getAuthenticationHeader($code){

            $codeMain=$code;

            $graphId = 'https://graph.microsoft.com/';    // Information about the resource we need access for which in this case is graph.
            $protectedResourceHostName = 'graph.windows.net';
            $graphPrincipalId = $graphId;

            $clientPrincipalId = '<ClientId>';  // Information about the app
            $clientSecret ='<ClientSecret>';

            // Construct the body for the STS request
            $authenticationRequestBody = 'grant_type=authorization_code&client_secret='.$clientSecret
                      .'&'.'resource='.$graphPrincipalId.'&'.'client_id='.$clientPrincipalId.'&code='.$codeMain.'&redirect_uri=<URL>';

            //Using curl to post the information to STS and get back the authentication response
            $ch = curl_init();
            // set url
            $stsUrl = 'https://login.windows.net/advaiya.com/oauth2/token?api-version=1.0';

            curl_setopt($ch, CURLOPT_URL, $stsUrl);
            // Get the response back as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // Mark as Post request
            curl_setopt($ch, CURLOPT_POST, 1);
            // Set the parameters for the request
            curl_setopt($ch, CURLOPT_POSTFIELDS,  $authenticationRequestBody);

            // By default, HTTPS does not work with curl.
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // read the output from the post request
            $output = curl_exec($ch);
          
            // close curl resource to free up system resources
            curl_close($ch);
            // decode the response from sts using json decoder
            $tokenOutput = json_decode($output);
           
            return $tokenOutput;
        }

        $code=$_REQUEST["code"];
     
        $tokendata=getAuthenticationHeader($code);

        $data1=($tokendata->{'access_token'});
       
        $data2=$tokendata->{'refresh_token'};
        
?><!DOCTYPE HTML>
