<?php

namespace App\Http\API\Models;

/**
 *  @OA\Schema(
 *    title="Информация об ошибке",
 *    required={"code", "message"}
 *  )
 */
class Error
{
  /**
   *  @OA\Property(
   *    description="Код"
   *  )
   *
   * @var string
   */
  private $code;

  /**
   *  @OA\Property(
   *    description="Сообщение"
   *  )
   *
   * @var string
   */
  private $message;
}
