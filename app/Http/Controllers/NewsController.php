<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\DanhMucTin\DanhMucTinService;
use App\Http\Services\TinTuc\TinTucService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Services\GioHangService;


class NewsController extends Controller
{
    protected $danhmuctin;
    protected $tintuc;
    protected $GioHangService;

    public function __construct(DanhMucTinService $danhmuctin, TinTucService $tintuc,  GioHangService $GioHangService)
    {
        $this->danhmuctin = $danhmuctin;
        $this->tintuc = $tintuc;
        $this->GioHangService = $GioHangService;

    }

    public function index(Request $request)
    {   
        $sanphams = $this->GioHangService->getSanPham();

        if ($request->has('danhmucid')) {

            $danhmucid = $request->get('danhmucid');

            return view('tintuc.news', [
                'title' => 'Tin tức',
                'danhmuctins' => $this->danhmuctin
                                ->getAll()->filter(function($danhmuctin){
                                    return boolval($danhmuctin->active) === true;
                                })
                                ->values(),
                'tintucs' => $this->tintuc->getByDMTinTucId($danhmucid),
            'sanphamgiohangs' => $sanphams,
            ]);
        }
        else
        return view('tintuc.news', [
            'title' => 'Tin tức',
            'danhmuctins' => $this->danhmuctin
                            ->getAll()->filter(function($danhmuctin){
                                return boolval($danhmuctin->active) === true;
                            })
                            ->values(),
            'tintucs' => $this->tintuc->get(),
            'sanphamgiohangs' => $sanphams,
        ]);
    }

    public function detail(Request $request){

        $tintucid = $request->get('id');
        $sanphams = $this->GioHangService->getSanPham();

        return view('tintuc.newsdetail', [
            'title' => 'Tin tức',
            'danhmuctins' => $this->danhmuctin
            ->getAll()->filter(function($danhmuctin){
                return boolval($danhmuctin->active) === true;
            })
            ->values(),
            'tintuc' => $this->tintuc->getById($tintucid),
            'sanphamgiohangs' => $sanphams,
        ]);
    }
}