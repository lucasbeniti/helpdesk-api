<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        $comments = Comment::where('user_id', $request->user()->id)
            ->paginate(10);

        return $this->successResponse(['comments' => CommentResource::collection($comments)], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'content' => 'string|max:255|required',
            'ticket_id' => 'required|exists:tickets,id'
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'ticket_id' => $request->ticket_id,
            'user_id' => $request->user()->id
        ]);

        return $this->successResponse(['comment' => $comment], 'Comentário criado com sucesso', 201);
    }
    
    public function show(Comment $comment): JsonResponse
    {
        return $this->successResponse(['comment' => new CommentResource($comment)], 200);
    }

    public function update(Request $request, Comment $comment): JsonResponse
    {
        $request->validate([
            'content' => 'string|max:255|required',
            'ticket_id' => 'required|exists:tickets,id'
        ]);

        $comment = Comment::update([
            'content' => $request->content,
            'ticket_id' => $request->ticket_id
        ]);

        return $this->successResponse(['comment' => $comment], 'Comentário atualizado com sucesso', 200);
    }

    public function delete(Comment $comment): JsonResponse
    {
        $comment->delete();

        return $this->successResponse([], 'Comentário deletado com sucesso', 200);
    }
}
