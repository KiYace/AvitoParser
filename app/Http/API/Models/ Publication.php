<?php

namespace App\Http\API\Models;

/**
 *  @OA\Schema(
 *    title="Публикация",
 *    required={"area_name", "post_id", "link"}
 *  )
 */
class Publication
{
  /**
   *  @OA\Property(
   *    description="ID публикации в БД"
   *  )
   *
   * @var integer
   */
  private $id;

  /**
   *  @OA\Property(
   *    description="Название площадки"
   *  )
   *
   * @var string
   */
  private $area_name;

  /**
   *  @OA\Property(
   *    description="ID публикации на площадке"
   *  )
   *
   * @var string
   */
  private $post_id;

  /**
   *  @OA\Property(
   *    description="Ссылка на публикацию"
   *  )
   *
   * @var string
   */
  private $link;
}
