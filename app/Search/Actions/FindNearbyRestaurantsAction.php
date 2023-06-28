<?php
namespace App\Search\Actions;

use App\Search\Domain\Restaurant;
use App\Services\RecruitApiService;
use App\Search\Responders\NearbyRestaurantsResponder;

/**
 * 주변 식당 확인 액션 클래스
 * - 사용자 위치 기반 가게 검색 기능을 수행
 */
class FindNearbyRestaurantsAction
{
  protected $recruitApiService;
  protected $responder;

  public function __construct(RecruitApiService $recruitApiService, NearbyRestaurantsResponder $responder)
  {
    $this->recruitApiService = $recruitApiService;
    $this->responder = $responder;
  }

  public function __invoke(float $latitude, float $longitude, float $range, ?string $keyword = null)
  {
    $restaurants = $this->recruitApiService->searchRestaurantsByUserLocation($latitude, $longitude, $range, $keyword);
    return $this->responder->respond($restaurants);
  }
}