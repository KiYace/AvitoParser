<?php

namespace App\Http\API\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Publication;

class OwnershipController extends Controller
{
  /**
   *  @OA\Get(
   *    path="/ownership/{area}",
   *    operationId="publicationsListAvito",
   *    summary="Публикации",
   *    tags={"Publications"},
   *    description="Доступные площадки:
- Авито - 'avito,
- Циан - 'cian,
- Домклик - 'domclick'",
   *    @OA\Parameter(
   *      name="area",
   *      in="path",
   *      required=true,
   *      @OA\Schema(
   *        type="string"
   *      ),
   *      description="Название площадки"
   *    ),
   *    @OA\Response(
   *      response=200,
   *      description="Успешно",
   *      @OA\JsonContent(
   *        @OA\Property(property="success", type="boolean"),
   *        @OA\Property(property="result", type="object",
   *          @OA\Property(property="publications", type="array", @OA\Items(ref="#/components/schemas/Publication"))
   *        )
   *      )
   *    ),
   *    @OA\Response(
   *      response="400",
   *      description="Невалидный запрос",
   *      @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
   *    ),
   *    @OA\Response(
   *      response="503",
   *      description="Сервис не доступен",
   *      @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
   *    ),
   *    @OA\Response(
   *      response="default",
   *      description="Ошибка",
   *      @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
   *    )
   *  )
   */
  public function publicationsList($area)
  {
    $publications = Publication::where('area_name', $area)->get();

    return make_success(['publications', $publications]);
  }
}
