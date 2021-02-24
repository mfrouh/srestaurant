<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Menu;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:الأراء'])->only('reviews');
        $this->middleware(['auth','permission:الرئيسية'])->only('index');
    }
    public function index()
    {
       $data=array();
       if (auth()->user()->can('المستخدمين')) {
       $users=User::role('مستخدم')->count();
       $data['users']=$users;
       }
       if (auth()->user()->can('الموظفين')) {
       $cashiers=User::role('كاشير')->count();
       $deliveries=User::role('عامل توصيل')->count();
       $superdeliveries=User::role('مشرف عمال التوصيل')->count();
       $superchefs=User::role('مشرف في المطبخ')->count();
       $chefs=User::role('طباخ')->count();
       $data=array_merge($data,['cashiers'=>$cashiers,'deliveries'=>$deliveries,'superdeliveries'=>$superdeliveries,'superchefs'=>$superchefs,'chefs'=>$chefs]);
       }
       if (auth()->user()->can('المنتجات')) {
       $products=Product::count();
       $actproducts=Product::active()->count();
       $inactproducts=Product::inactive()->count();
       $data=array_merge($data,['products'=>$products,'actproducts'=>$actproducts,'inactproducts'=>$inactproducts]);
       }
       if (auth()->user()->can('الوظائف')) {
       $roles=Role::count();
       $data['roles']=$roles;
       }
       if (auth()->user()->can('الصلاحيات')) {
       $permissions=Permission::count();
       $data['permissions']=$permissions;
       }
       if (auth()->user()->can('الاقسام')) {
       $categories=Category::count();
       $actcategories=Category::active()->count();
       $inactcategories=Category::inactive()->count();
       $data=array_merge($data,['categories'=>$categories,'actcategories'=>$actcategories,'inactcategories'=>$inactcategories]);
       }
       if (auth()->user()->can('القوائم')) {
       $menus=Menu::count();
       $actmenus=Menu::active()->count();
       $inactmenus=Menu::inactive()->count();
       $data=array_merge($data,['menus'=>$menus,'actmenus'=>$actmenus,'inactmenus'=>$inactmenus]);
       }
       if (auth()->user()->can('الطلبات')) {
         $orders=Order::count();
         $corders=Order::where('status','!=','Completed')->count();
         $inrestorders=Order::where('type','Inrestaurant')->count();
         $dlorders=Order::where('type','Delivery')->count();
         $tkorders=Order::where('type','Takeway')->count();
         $pendingorders=Order::where('status','Pending')->count();
         $processingorders=Order::where('status','processing')->count();
         $endprocessingorders=Order::where('status','Endprocessing')->count();
         $deliveryorders=Order::where('status','Delivery')->count();
         $completedorders=Order::where('status','Completed')->count();
         $worders=Order::where('status','Completed')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
         $dorders=Order::where('status','Completed')->whereDay('created_at', now())->count();
         $morders=Order::where('status','Completed')->whereMonth('created_at', now())->count();
         $yorders=Order::where('status','Completed')->whereYear('created_at', now())->count();
         $data=array_merge($data,['orders'=>$orders,'corders'=>$corders,'inrestorders'=>$inrestorders,'dlorders'=>$dlorders,
         'tkorders'=>$tkorders,'deliveryorders'=>$deliveryorders,'pendingorders'=>$pendingorders,
         'processingorders'=>$processingorders,'endprocessingorders'=>$endprocessingorders,'completedorders'=>$completedorders
        ,'worders'=>$worders,'dorders'=>$dorders,'morders'=>$morders,'yorders'=>$yorders]);
       }
       if (auth()->user()->can('العروض')) {
       $offers=Offer::count();
       $actoffers=Offer::active()->count();
       $inactoffers=Offer::inactive()->count();
       $data=array_merge($data,['offers'=>$offers,'inactoffers'=>$inactoffers,'actoffers'=>$actoffers]);
       }
       if (auth()->user()->can('الخصومات')) {
       $coupons=Coupon::count();
       $actcoupons=Coupon::active()->count();
       $inactcoupons=Coupon::inactive()->count();
       $data=array_merge($data,['coupons'=>$coupons,'actcoupons'=>$actcoupons,'inactcoupons'=>$inactcoupons]);
       }
       if (auth()->user()->can('الأراء')) {
       $reviews=Review::count();
       $data['reviews']=$reviews;
       }
       if (auth()->user()->HasRole('كاشير')) {
           $data=$this->cashier($data);
       }
       if (auth()->user()->HasRole('مشرف في المطبخ')) {
           $data=$this->superkitchen($data);
       }
       if (auth()->user()->HasRole('مشرف عمال التوصيل')) {
           $data=$this->superdelivery($data);
       }
       if (auth()->user()->HasRole('عامل توصيل')) {
           $data=$this->delivery($data);
       }
       if (auth()->user()->HasRole('طباخ')) {
           $data=$this->chef($data);
       }
       return view('Backend.dashboard.index')->with($data);
   }
  private function superkitchen($data)
  {
    $csuperkitchenorders=Order::where('superkitchen_by',auth()->user()->id)->where('status','!=','Completed')->count();
    $wsuperkitchenorders=Order::where('superkitchen_by',auth()->user()->id)->where('status','Completed')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $dsuperkitchenorders=Order::where('superkitchen_by',auth()->user()->id)->where('status','Completed')->whereDay('created_at', now())->count();
    $msuperkitchenorders=Order::where('superkitchen_by',auth()->user()->id)->where('status','Completed')->whereMonth('created_at', now())->count();
    $ysuperkitchenorders=Order::where('superkitchen_by',auth()->user()->id)->where('status','Completed')->whereYear('created_at', now())->count();
    return $data[]=array_merge($data,['ysuperkitchenorders'=>$ysuperkitchenorders,'msuperkitchenorders'=>$msuperkitchenorders,'dsuperkitchenorders'=>$dsuperkitchenorders,'wsuperkitchenorders'=>$wsuperkitchenorders,'csuperkitchenorders'=>$csuperkitchenorders]);
  }
  private function cashier($data)
  {
    $ccashierorders=Order::where('created_by',auth()->user()->id)->where('status','!=','Completed')->count();
    $wcashierorders=Order::where('created_by',auth()->user()->id)->where('status','Completed')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $dcashierorders=Order::where('created_by',auth()->user()->id)->where('status','Completed')->whereDay('created_at', now())->count();
    $mcashierorders=Order::where('created_by',auth()->user()->id)->where('status','Completed')->whereMonth('created_at', now())->count();
    $ycashierorders=Order::where('created_by',auth()->user()->id)->where('status','Completed')->whereYear('created_at', now())->count();
    return $data[]=array_merge($data,['ycashierorders'=>$ycashierorders,'mcashierorders'=>$mcashierorders,'dcashierorders'=>$dcashierorders,'wcashierorders'=>$wcashierorders,'ccashierorders'=>$ccashierorders]);
  }
  private function superdelivery($data)
  {
    $csuperdeliveryorders=Order::where('superdelivery_by',auth()->user()->id)->where('status','!=','Completed')->count();
    $wsuperdeliveryorders=Order::where('superdelivery_by',auth()->user()->id)->where('status','Completed')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $dsuperdeliveryorders=Order::where('superdelivery_by',auth()->user()->id)->where('status','Completed')->whereDay('created_at', now())->count();
    $msuperdeliveryorders=Order::where('superdelivery_by',auth()->user()->id)->where('status','Completed')->whereMonth('created_at', now())->count();
    $ysuperdeliveryorders=Order::where('superdelivery_by',auth()->user()->id)->where('status','Completed')->whereYear('created_at', now())->count();
    return $data[]=array_merge($data,['ysuperdeliveryorders'=>$ysuperdeliveryorders,'msuperdeliveryorders'=>$msuperdeliveryorders,'dsuperdeliveryorders'=>$dsuperdeliveryorders,'wsuperdeliveryorders'=>$wsuperdeliveryorders,'csuperdeliveryorders'=>$csuperdeliveryorders]);
  }
  private function chef($data)
  {
    $ccheforders=OrderDetails::where('created_by',auth()->user()->id)->where('status','!=','Completed')->count();
    $wcheforders=OrderDetails::where('created_by',auth()->user()->id)->where('status','Completed')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $dcheforders=OrderDetails::where('created_by',auth()->user()->id)->where('status','Completed')->whereDay('created_at', now())->count();
    $mcheforders=OrderDetails::where('created_by',auth()->user()->id)->where('status','Completed')->whereMonth('created_at', now())->count();
    $ycheforders=OrderDetails::where('created_by',auth()->user()->id)->where('status','Completed')->whereYear('created_at', now())->count();
    return $data[]=array_merge($data,['ycheforders'=>$ycheforders,'mcheforders'=>$mcheforders,'dcheforders'=>$dcheforders,'wcheforders'=>$wcheforders,'ccheforders'=>$ccheforders]);
  }
   private function delivery($data)
   {
    $cdeliveryorders=Order::where('delivery_by',auth()->user()->id)->where('status','!=','Completed')->count();
    $wdeliveryorders=Order::where('delivery_by',auth()->user()->id)->where('status','Completed')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $ddeliveryorders=Order::where('delivery_by',auth()->user()->id)->where('status','Completed')->whereDay('created_at', now())->count();
    $mdeliveryorders=Order::where('delivery_by',auth()->user()->id)->where('status','Completed')->whereMonth('created_at', now())->count();
    $ydeliveryorders=Order::where('delivery_by',auth()->user()->id)->where('status','Completed')->whereYear('created_at', now())->count();
    return $data[]=array_merge($data,['ydeliveryorders'=>$ydeliveryorders,'mdeliveryorders'=>$mdeliveryorders,'ddeliveryorders'=>$ddeliveryorders,'wdeliveryorders'=>$wdeliveryorders,'cdeliveryorders'=>$cdeliveryorders]);
   }

   public function reviews(Request $request)
   {
     if ($request->ajax()) {
         $data = Review::select('*');
         return DataTables::of($data)
                 ->make(true);
     }
     return view('Backend.review.index');
   }
}
