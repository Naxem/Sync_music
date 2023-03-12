<?php

// Define client credentials
$client_id = "3795e7582670443aba6add4985b2433f";
$client_secret = "66a10e796e51448bb7205374de3c47c0";
$redirect_uri = "http://127.0.0.1/sync_music/php/callback";

// Set authorization endpoint URL
$authorize_url = "https://accounts.spotify.com/authorize";

// Set token endpoint URL
$token_url = "https://accounts.spotify.com/api/token";

// Set scope(s)
$scope = "user-read-private user-read-email";

// Redirect user to authorize endpoint
header("Location: " . $authorize_url . "?response_type=code&client_id=" . $client_id . "&scope=" . $scope . "&redirect_uri=" . $redirect_uri);
exit;

// Upon redirect from authorization server, exchange authorization code for access token
if (isset($_GET["code"])) {
    // Define POST data
    $post_data = array(
        "grant_type" => "authorization_code",
        "code" => $_GET["code"],
        "redirect_uri" => $redirect_uri,
        "client_id" => $client_id,
        "client_secret" => $client_secret
    );
    
    // Send POST request to token endpoint
    $curl = curl_init($token_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    
    // Decode JSON response
    $token_data = json_decode($response, true);
    
    // Use access token to access Spotify Web API
    $access_token = $token_data["access_token"];
    $curl = curl_init("https://api.spotify.com/v1/me");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    
    // Decode JSON response
    $user_data = json_decode($response, true);
    
    // Print user data
    print_r($user_data);


$ch = curl_init();

// configure l'URL de l'API Spotify
curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/browse/categories/toplists/playlists");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// ajoute le token d'accès à l'en-tête de la requête
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer <votre_token_d'accès>"
));

$response = curl_exec($ch);

// ferme la session cURL
curl_close($ch);

// affiche la réponse JSON
echo $response;

}
?>