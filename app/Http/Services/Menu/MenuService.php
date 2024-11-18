<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use App\Models\SanPham;
use App\Models\songs;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

class MenuService{
    public function getParent(){
        return Menu::where('parent_id',0)->get();
    }
    public function danhmuc(){
        $menus = DB::table('menus as parent')
        ->leftJoin('menus as child', 'child.parent_id', '=', 'parent.id')
        ->leftJoin('san_phams', function ($join) {
            $join->on('san_phams.menu_id', '=', 'parent.id')
                 ->orOn('san_phams.menu_id', '=', 'child.id');
        })
        ->select('parent.id as category_id','parent.name as category_name', DB::raw('COUNT(san_phams.id) as product_count'))
        ->where('parent.parent_id','0') // Chỉ lấy danh mục cha
        ->groupBy('parent.id', 'parent.name')
        ->orderByDesc('product_count')
        ->get();
        return $menus;
    }
   
    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);   
    }
    public function create($request){
        try{
            Menu::create([
                'name' => (string)$request->input('name'),
                'thumb' => (string)$request->input('thumb'),
                'parent_id' => (int)$request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active'),
                'slug'=> Str::slug($request->input('name'),'-')
            ]);
            
            Session::flash('Success','Tạo danh mục thành công');

        }catch(\Exception $err){
            Session::flash('Error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function update($request, $menu): bool
    {
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string)$request->input('name');
        $menu->thumb = (string)$request->input('thumb');
        $menu->description = (string)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();

        
        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }
    public function maingetall()
    {
        
            return Menu::
            orderByDesc('id')->paginate(16);
    }
    public function show()
    {
        return Menu::select('name', 'id')
        ->where('parent_id', 0)
        ->orderbyDesc('id')
        ->get();
    }
    public function show4()
    {
        return Menu::whereIn('id', [13, 9, 4, 3])->get();
    }
    

    public function more($id)
    {
        return Menu::
            where('active', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }

    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
}