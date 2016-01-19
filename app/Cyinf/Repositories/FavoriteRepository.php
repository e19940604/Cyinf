<?php
namespace Cyinf\Repositories;

use Cyinf\Favorite;

class FavoriteRepository
{
    /** @var Favorite 注入的 Favorite model */
    protected $favorite;

    /**
     * UserRepository constructor.
     *
     * @param Favorite $favorite
     */
    public function __construct( Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

}