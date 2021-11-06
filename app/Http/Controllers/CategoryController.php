<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catsCol = DB::table('categories')->get();
        $cats_value = $catsCol->all();
        $cats_key = $catsCol->pluck('id')->all();
        $cats = array_combine($cats_key, $cats_value);
        $cats2 = [];

        foreach ($cats as $k => $v) {
            if ($v->parent_id !== null) {
                if (isset($cats[$v->parent_id])) {
                    $cats[$v->parent_id]->children[] = $v;
                    $cats2[$k] = &$cats[$v->parent_id]->children[count($cats[$v->parent_id]->children) - 1];
                } else {
                    $cats2[$v->parent_id]->children[] = $v;
                    $cats2[$k] = &$cats2[$v->parent_id]->children[count($cats2[$v->parent_id]->children) - 1];
                }
                unset($cats[$k]);
            }
        }
        ksort($cats);
        return response()->json(['categories' => $cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
