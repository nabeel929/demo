<?php 

namespace App\Http\Controllers;
use  App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller {



     public function addComment(Request $request){
        \Log::info('Controller reached');
        $request->validate([
            'user' => 'required|string|max:255',
            'comments'  => 'required|string',
            'post_id' => 'required|integer',
            'status' => 'required|string|max:50'
        ]);

        $comment = Comments::create($request->only('user', 'comments', 'post_id', 'status'));

        return response()->json([

            'success'=> true,
            "message" => "commets is created succesfully",
            "data" =>$comment
        ],201);

}


public function getComment(){
    $comments = Comments::all();

    return response()->json([
        'status'=>true,
        'message'=> 'all comments',
        'data' => $comments,
    ],200);
}

public function deleteComment($id){
    $comment = Comments::find($id);

    if(!$comment){
        return response()->json([
            "status" =>false,
            "message" =>"comment not found ",


        ],404);
    }

    else{
        $comment->delete();
        return response()->json([
            "message"=>"dleeted successfully",
            "status"=> true,
        ],200);
    }
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
        'user' => 'sometimes|string|max:255',
        'comments' => 'sometimes|string',
        'post_id' => 'sometimes|integer',
        'status' => 'sometimes|string|max:50'
    ]);

    $comment->update($request->only('user', 'comments', 'post_id', 'status'));

    return response()->json([
        'status' => true,
        'message' => 'Comment updated successfully!',
        'data' => $comment
    ], 200);
}


}


