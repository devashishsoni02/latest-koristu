<?php

namespace Modules\ProductService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\ProductService\Entities\Category;
use Modules\ProductService\Entities\ProductService;
use Modules\ProductService\Events\CreateCategory;
use Modules\ProductService\Events\DestroyCategory;
use Modules\ProductService\Events\UpdateCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(Auth::user()->can('category create'))
        {
            $product_categories = \Modules\ProductService\Entities\Category::where('created_by', '=', creatorId())->where('workspace_id',getActiveWorkSpace())->where('type',0)->get();
            $income_categories = \Modules\ProductService\Entities\Category::where('created_by', '=', creatorId())->where('workspace_id',getActiveWorkSpace())->where('type',1)->get();
            $expance_categories = \Modules\ProductService\Entities\Category::where('created_by', '=', creatorId())->where('workspace_id',getActiveWorkSpace())->where('type',2)->get();
            $taxes = \Modules\ProductService\Entities\Tax::where('created_by',creatorId())->where('workspace_id',getActiveWorkSpace())->get();
            $units = \Modules\ProductService\Entities\Unit::where('created_by',creatorId())->where('workspace_id',getActiveWorkSpace())->get();

            return view('productservice::category.index',compact('product_categories','income_categories','expance_categories','taxes','units'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if(Auth::user()->can('category create'))
        {
            $types = !empty($request->type) ? $request->type : 0;
            return view('productservice::category.create',compact('types'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if(Auth::user()->can('category create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required|max:20',
                    'type' => 'required',
                    'color' => 'required',
                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $category             = new Category();
            $category->name       = $request->name;
            $category->color      = $request->color;
            $category->type       = $request->type;
            $category->created_by = \Auth::user()->id;
            $category->workspace_id =  getActiveWorkSpace();
            $category->save();

            event(new CreateCategory($request,$category));
            return redirect()->route('category.index')->with('success', __('Category successfully created.'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return redirect()->route('category.index')->with('error', __('Permission denied.'));
        return view('productservice::category.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if(Auth::user()->can('category edit'))
        {
            $category = Category::find($id);

            return view('productservice::category.edit', compact('category'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->can('category edit'))
        {
            $category = Category::find($id);
            if($category->created_by == \Auth::user()->id)
            {
                $validator = \Validator::make(
                    $request->all(), [
                                        'name' => 'required|max:20',
                                        'color' => 'required',
                                    ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $category->name  = $request->name;
                $category->color = $request->color;
                $category->save();
                event(new UpdateCategory($request,$category));
                return redirect()->route('category.index')->with('success', __('Category successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if(Auth::user()->can('category delete'))
        {
            $category = Category::find($id);
            $product_categorie=ProductService::where('category_id',$category->id)->get();
            if(count($product_categorie)==0){
                event(new DestroyCategory($category));
                $category->delete();
            }else{

            return redirect()->route('category.index')->with('error', __('This Category has Product. Please remove the Product from this Category.'));

            }
            return redirect()->route('category.index')->with('success', __('Category successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
