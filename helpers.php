<?php

use Illuminate\Http\Response;

if (!function_exists('make_success')) {
  function make_success($result = [])
  {
    $response = ['success' => true];
    if (!empty($result)) {
      $response['result'] = $result;
    }
    return response($response, Response::HTTP_OK);
  }
}
?>
