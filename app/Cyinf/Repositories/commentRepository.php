<?php
namespace Cyinf\Repositories;

use Cyinf\Comment;

class CommentRepository
{
    /** @var Comment 注入的 Comment model */
    protected $comment;


    /**
     * CommentRepository constructor.
     *
     * @param Comment $comment
     */
    public function __construct( Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * get the total comment number
     *
     * @return int
     */
    public function countTotalComment()
    {
        return $this->comment->all()->count();
    }

    /**
     * get latest Comment
     *
     * @return mixed
     */
    public function latestComment( $number )
    {
        return $this->comment->query()
            ->distinct('course_id')
            ->with('course')
            ->orderBy('id' , 'desc')
            ->limit( $number )
            ->get();
    }


}