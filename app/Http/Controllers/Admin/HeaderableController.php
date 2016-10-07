<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

class HeaderableController extends BackendController
{
    /**
     * Delete Image
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        $className = $request->get('model_class');
        $modelId   = $request->get('model_id');

        $model = new $className();

        $item = $model->findOrFail($modelId);
        $item->deleteHeaderFile(true);

        if($request->ajax()) {
            return response()->json([
                'status'  => 'ok',
                'message' => 'Фотография удалена',
            ]);
        }

        return redirect($request->session()->previousUrl());
    }
}
