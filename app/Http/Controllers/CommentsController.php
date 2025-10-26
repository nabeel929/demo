<?php 

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function addComment(Request $request)
    {
        \Log::info('Controller reached');

        $request->validate([
            'comments'  => 'required|string',
            'post_id' => 'required|integer',
            'status' => 'required|string|max:50'
        ]);

        
        $user = $request->user();

    
        $comment = Comments::create([
            'user' => $user->name,
            'comments' => $request->comments,
            'post_id' => $request->post_id,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment created successfully!',
            'data' => $comment
        ], 201);
    }

    
    public function getComment()
    {
        $comments = Comments::all();

        return response()->json([
            'status' => true,
            'message' => 'All comments',
            'data' => $comments,
        ], 200);
    }

    
    public function deleteComment($id)
    {
        $comment = Comments::find($id);

        if (!$comment) {
            return response()->json([
                'status' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Comment deleted successfully!',
        ], 200);
    }

    
    public function updateComment(Request $request, $id)
    {
        $comment = Comments::find($id);

        if (!$comment) {
            return response()->json([
                'status' => false,
                'message' => 'Comment not found',
            ], 404);
        }

        $request->validate([
            'comments' => 'sometimes|string',
            'post_id' => 'sometimes|integer',
            'status' => 'sometimes|string|max:50'
        ]);

        $comment->update($request->only('comments', 'post_id', 'status'));

        return response()->json([
            'status' => true,
            'message' => 'Comment updated successfully!',
            'data' => $comment
        ], 200);
    }
}
