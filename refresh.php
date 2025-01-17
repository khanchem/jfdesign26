<?php

// Configuration
$clientId = '08f8124d-c77e-4b70-b531-3c7670cdbe91'; // Replace with your actual Client ID
$refreshToken = 'eyJjdHkiOiJKV1QiLCJlbmMiOiJBMjU2R0NNIiwiYWxnIjoiUlNBLU9BRVAifQ.NetPBOQFKTnAfB9cwtVePEiwqTClNoAUR0n1ENGzqH4HjuScK3SxH-7dchesb45c6fgg6CXr9jhrPpv3w7kTjZvfTF6Ndbq8uHTmTVgn6_S2Xjk0Zqnbt3pD_lTxtwcT9LwvV2IPXPeuk67RiONrDQhfjwjyX3ay1i6nMtbI53xWFe0V7GDrYKhm4oEAswZKzV63HDv7VhobxJbXaWP5uEJEEIoKGH3-LOWyY2OyG2r7yFWAtyIsIJiwgZmqHJgR8-VQINzwbPl-a7F7JVUiQk51TBvbadGXkWtCH3RTcK2PHiwiC2B7u79L7045lsy7vTxKqw3W5z6hu162DVWDnQ.LIZrA1PdrSsf0Gsj.wmb8kD8T7v8xW5vkAKaogwjPaAD5aBR9IuL6qplzCgM67UgbBRVF4D6GELfzYU5lfmvwotSVEdn193I3egFcOvbxDHThv3mVCe53pR7Xw10puoCFInQeUiO-yQlkSnaCe_I7ixkHU4gqL0lccpIFSqA05_-q6WZ9Y7uXMGBqIW_DQVPPC_wXe9MCKooFk8WuzzjYWSa9bS095YHSLTX4FEwtUSZZbxmueu4OWijsv1ws3Y9cMLHgmRqVzp6vuNGzX5RruXx5Dp4wPYFXNgUMLToYF88_W65IFCivgWia06UPPNmvc0ZkhajvyYZJLdyux4K2HSJOLwUnZfEhIP42LuJUlIkReN9Oa9WL83nLhkGx3p0X8BOpzqa3jhCKo4KEX0ScN_ik1vjUOveKMZKXfpssnxFGVfLvAtYfSRmwJlNnXCvkAFTW7RB2eRnUj-Ab-J5WZ1O8W6vBRHK-weF8TmeoL24_WJhvpTe7jMR-LPrvl2aztWPMR5cEiNGZ6ZtFigCcgTHRTd6nV5i3jZkFsLknMWebtcBAuURiE3XYuCj4ZFUYaJhF4J6Umr5F4uNoyALixXocsnfT1zHdFdpvCiKGZ_ahsXphqr37_n8cIazk3Vd21Pf5fmobas4_7FzY7UNMeIogAFiVMSK8O5eHzRC_YnFAs0VvDjZ_OrEcwYr_ZdjfDfpmEDG1G4Nwc1SvlhXNfx3d1ACwlVVpV3BjuZ3bwGsZfO6W_lBdyEYZxBgleejv0ShrTbyQ9dhcuc3EaACkOAGxtcAWwQrOHh5_dL0TCfkPfq4vnsH75-YEzIMJHQfUazhPP2dGE6DzIKC4WVFFxYgjX0pznu4sfFMNUfPM10wD-13kKk2ISxARnjvsuaOtjdKv9eyU_0tRHeCRHXY2OM-cHvLYB-gHmofPKTxkO_NM26WmtpCZHpAxF1gNBerbXP1CcNNjt_jm11zEj1xu7dNYE_n24fV_zYlpXexuPFfdfejWlXHR3rk_O4FXrFAM_ce22g6cA4EMcakoANOLsgkvLBFE1M55-bSSu6B8XLzXDV3bYwYYmkOZ-hJGkoBXERmnGQLiCe8VuHQ8gw1QB1Q5KeiJTVkOEfW2s6Kz6-TqYNjS9DWpUDupVBvmCGIBcJAeyExfKjLNoXqfg10BTSfAjn3xJj8N_pLfPaFRIGBG6cU0u_ZYf7VlH9DzR7PQSzIhr6ykGehYPbcOVJsvVZV53bqk2bMY6hg03s_IJ7rUryzDmeHwAdpRHZbbvucBmWu0eQxr6s_DZT-t.bN3IQuT7vcQawqRYl1O4vA'; // Replace with your actual Refresh Token

// API URL for refreshing the token
$url = 'https://id.vincere.io/oauth2/token';

// Prepare the POST data
$data = [
    'client_id' => $clientId,
    'grant_type' => 'refresh_token',
    'refresh_token' => $refreshToken,
];

// Initialize cURL session
$curl = curl_init($url);

// Set the HTTP method to POST
curl_setopt($curl, CURLOPT_POST, true);

// Set the POST fields
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

// Set the headers
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded',
]);

// Return the response instead of outputting it
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the request and capture the response
$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    // Output the response
    echo "Response:\n" . $response;
}

// Close the cURL session
curl_close($curl);
?>