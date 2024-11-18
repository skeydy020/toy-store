<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{   
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }


    public function create(){
        if(Auth::id() == 1 )
        return view('admin.menu.add',[
            'title'=>'Thêm danh mục'    ,
            'menus'=>$this->menuService->getParent()
        ]);
        else echo "404 not found";
    }
    public function store(CreateFormRequest $request){
                
         $result = $this->menuService->create($request);

         return redirect('/admin/menus/list');
    }

    public function index(){
        if(Auth::id() == 1 )
        return view('admin.menu.list',[
            'title' => 'Danh sách các danh mục',
            'menus'=> $this->menuService->getAll()
        ]);
        
        else echo "404 not found";
    } 

    public function show(Menu $menu)
    {   
        if(Auth::id() == 1 )
        return view('admin.menu.edit', [
            'title' => 'Chỉnh Sửa Danh Mục: ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
        else echo "404 not found";
    }

    public function update(Menu $menu, CreateFormRequest $request)
    {
        $this->menuService->update($request, $menu);

        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->menuService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }


}
