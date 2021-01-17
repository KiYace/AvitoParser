<?php

namespace App\Http\API\Models;

/**
 *  @OA\Schema(
 *    title="Ответ от сервера в случае ошибки",
 *    required={"success"}
 *  )
 */
class ErrorResponse
{
  /**
   *  @OA\Property(
   *    description="Флаг успеха",
   *    default=false
   *  )
   *
   * @var boolean
   */
  private $success;

  /**
   *  @OA\Property(ref="#/components/schemas/Error")
   *
   * @var object
   */
  private $error;
}
