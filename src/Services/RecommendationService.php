<?php

namespace App\Services;

use App\Entity\Beer;
use App\Repository\BeerRepository;
use App\Repository\QuoteRepository;
use App\Repository\StatisticRepository;

class RecommendationService
{
    private $statistic;

    public function __construct(StatisticRepository $statistic)
    {

        $this->statistic = $statistic;
    }

    public function all($min = 16, $max = 20): array
    {

        return $this->statistic->findBestBeer($min, $max);
    }

    public function is(int $id) 
    {

        foreach($this->statistic->getIds() as $relation){
            if( $relation['id'] === $id)  return round( $relation['avg_score'], 1 ) ;
        }

        return null;
    }
}
