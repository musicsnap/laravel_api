<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PostRepository;
use App\Models\Post;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
