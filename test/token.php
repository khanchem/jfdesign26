<?php

// Configuration
$clientId = ''; 
$refreshToken = '-7dchesb45c6fgg6CXr9jhrPpv3w7kTjZvfTF6Ndbq8uHTmTVgn6_S2Xjk0Zqnbt3pD_lTxtwcT9LwvV2IPXPeuk67RiONrDQhfjwjyX3ay1i6nMtbI53xWFe0V7GDrYKhm4oEAswZKzV63HDv7VhobxJbXaWP5uEJEEIoKGH3-LOWyY2OyG2r7yFWAtyIsIJiwgZmqHJgR8-VQINzwbPl-a7F7JVUiQk51TBvbadGXkWtCH3RTcK2PHiwiC2B7u79L7045lsy7vTxKqw3W5z6hu162DVWDnQ.LIZrA1PdrSsf0Gsj.wmb8kD8T7v8xW5vkAKaogwjPaAD5aBR9IuL6qplzCgM67UgbBRVF4D6GELfzYU5lfmvwotSVEdn193I3egFcOvbxDHThv3mVCe53pR7Xw10puoCFInQeUiO-yQlkSnaCe_I7ixkHU4gqL0lccpIFSqA05_-q6WZ9Y7uXMGBqIW_DQVPPC_wXe9MCKooFk8WuzzjYWSa9bS095YHSLTX4FEwtUSZZbxmueu4OWijsv1ws3Y9cMLHgmRqVzp6vuNGzX5RruXx5Dp4wPYFXNgUMLToYF88_W65IFCivgWia06UPPNmvc0ZkhajvyYZJLdyux4K2HSJOLwUnZfEhIP42LuJUlIkReN9Oa9WL83nLhkGx3p0X8BOpzqa3jhCKo4KEX0ScN_ik1vjUOveKMZKXfpssnxFGVfLvAtYfSRmwJlNnXCvkAFTW7RB2eRnUj-Ab-J5WZ1O8W6vBRHK-weF8TmeoL24_WJhvpTe7jMR-LPrvl2aztWPMR5cEiNGZ6ZtFigCcgTHRTd6nV5i3jZkFsLknMWebtcBAuURiE3XYuCj4ZFUYaJhF4J6Umr5F4uNoyALixXocsnfT1zHdFdpvCiKGZ_ahsXphqr37_n8cIazk3Vd21Pf5fmobas4_7FzY7UNMeIogAFiVMSK8O5eHzRC_YnFAs0VvDjZ_OrEcwYr_ZdjfDfpmEDG1G4Nwc1SvlhXNfx3d1ACwlVVpV3BjuZ3bwGsZfO6W_lBdyEYZxBgleejv0ShrTbyQ9dhcuc3EaACkOAGxtcAWwQrOHh5_dL0TCfkPfq4vnsH75-YEzIMJHQfUazhPP2dGE6DzIKC4WVFFxYgjX0pznu4sfFMNUfPM10wD-13kKk2ISxARnjvsuaOtjdKv9eyU_0tRHeCRHXY2OM-cHvLYB-gHmofPKTxkO_NM26WmtpCZHpAxF1gNBerbXP1CcNNjt_jm11zEj1xu7dNYE_n24fV_zYlpXexuPFfdfejWlXHR3rk_O4FXrFAM_ce22g6cA4EMcakoANOLsgkvLBFE1M55-bSSu6B8XLzXDV3bYwYYmkOZ-hJGkoBXERmnGQLiCe8VuHQ8gw1QB1Q5KeiJTVkOEfW2s6Kz6-TqYNjS9DWpUDupVBvmCGIBcJAeyExfKjLNoXqfg10BTSfAjn3xJj8N_pLfPaFRIGBG6cU0u_ZYf7VlH9DzR7PQSzIhr6ykGehYPbcOVJsvVZV53bqk2bMY6hg03s_IJ7rUryzDmeHwAdpRHZbbvucBmWu0eQxr6s_DZT-t.bN3IQuT7vcQawqRYl1O4vA'; // Replace with your actual Refresh Token

$tokenFilePath = 'token.json';


function refreshToken($clientId, $refreshToken) {
    $url = 'https://id.vincere.io/oauth2/token';
    $data = [
        'client_id' => $clientId,
        'grant_type' => 'refresh_token',
        'refresh_token' => $refreshToken,
    ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        echo "cURL Error: " . curl_error($curl);
        return null;
    }
    curl_close($curl);

    return json_decode($response, true);
}


if (file_exists($tokenFilePath)) {
    $tokenData = json_decode(file_get_contents($tokenFilePath), true);

    // Check if the token has expired (or doesn't exist)
    if (isset($tokenData['access_token']) && isset($tokenData['expires_in']) && isset($tokenData['timestamp'])) {
        $expiryTime = $tokenData['timestamp'] + $tokenData['expires_in'];

        // If token is not expired, use it
        if ($expiryTime > time()) {
            echo "Using existing token.\n";
            $accessToken = $tokenData['access_token'];
        } else {
            echo "Token expired, refreshing...\n";
            $newTokenData = refreshToken($clientId, $refreshToken);
            if ($newTokenData) {
                // Save the new token and update the timestamp
                $newTokenData['timestamp'] = time();
                file_put_contents($tokenFilePath, json_encode($newTokenData, JSON_PRETTY_PRINT));
                echo "New token saved.\n";
                $accessToken = $newTokenData['access_token'];
            } else {
                echo "Failed to refresh token.\n";
                exit;
            }
        }
    } else {
        echo "Token is invalid or missing, refreshing...\n";
        $newTokenData = refreshToken($clientId, $refreshToken);
        if ($newTokenData) {
            // Save the new token and update the timestamp
            $newTokenData['timestamp'] = time();
            file_put_contents($tokenFilePath, json_encode($newTokenData, JSON_PRETTY_PRINT));
            echo "New token saved.\n";
            $accessToken = $newTokenData['access_token'];
        } else {
            echo "Failed to refresh token.\n";
            exit;
        }
    }
} else {
    echo "No token file found, refreshing...\n";
    $newTokenData = refreshToken($clientId, $refreshToken);
    if ($newTokenData) {
        // Save the new token and update the timestamp
        $newTokenData['timestamp'] = time();
        file_put_contents($tokenFilePath, json_encode($newTokenData, JSON_PRETTY_PRINT));
        echo "New token saved.\n";
        $accessToken = $newTokenData['access_token'];
    } else {
        echo "Failed to refresh token.\n";
        exit;
    }
}

echo "Access Token: " . $accessToken . "\n";

?>
