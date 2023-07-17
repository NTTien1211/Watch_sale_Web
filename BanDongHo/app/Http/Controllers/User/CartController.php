<?php
namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartview(Request $request ,$idsp){
        $iduser = $request->iduser;
        Session::put('iduser', $iduser);
        $idsp = $request->idsp;
        $soluong = $request->soluong;
        $namesp = $request->namesp;
        $giasp = $request->giasp;
        $giagoc = $request->giagoc;
        $chitietsp = $request->chitietsp;
        $imgsp = $request->imgsp;

        $check = DB::table('cart')->where([
            ['iduser',$iduser],
            ['idproduct',$idsp],
        ])->count();
        // dd($check);


        if($check == 0){

            DB::table('cart')
            ->insert(['iduser' => $iduser,'idproduct' => $idsp,'soluong' => $soluong,'namesp' => $namesp,'giasp' => $giasp,'giagoc' => $giagoc,'chitietsp' => $chitietsp, 'imgsp' => $imgsp, ]
            );
        }

        if($check != 0){
                DB::table('cart')
                ->where([
                    ['iduser',$iduser],
                    ['idproduct',$idsp],
                ])
                ->update(['soluong' => $soluong]);
        }
        return redirect('/user/pages/sanpham/cart/');



    }
    public function viewProductCart(){
        // $iduser = $request->iduser;
        $iduser = Session::get('iduser');

        $userproducts = DB::table('cart')->where('iduser',$iduser)->get();


        return view('user.pages.cart', compact('userproducts'));
        dd($iduser);

    }

    public function deletecart($idsp){
        $iduser = session::get('iduser');
        DB::table('cart')
        ->where([
            ['iduser',$iduser],
            ['idproduct',$idsp],
        ])->delete();
        return redirect()->back();
    }

    public function magiamgiaa(Request $request){

                $magiamgia = $request -> magiamgia;
                dd($magiamgia);

    }

    public function viewPay(){
        $iduser = Session::get('iduser');
        $payuser = DB::table('cart')->where('iduser',$iduser)->get();
        // dd($iduser);
        return view('user.pages.pay',compact('payuser'));
    }
    public function Pay(Request $request ,$idsp){
        $iduser = $request->iduser;
        Session::put('iduser', $iduser);
        $idsp= $request->idproduct;
        $soluong = $request->soluong;
        $namesp = $request->tenSp;
        $giasp = $request->gia;

        $check = DB::table('cart')->where([
            ['iduser',$iduser],
            ['idproduct',$idsp],
        ])->count();
        // dd($check);


        // if($check == 0){

        //     DB::table('cart')
        //     ->insert(['iduser' => $iduser,'idproduct' => $idsp,'soluong' => $soluong,'tensp' => $namesp,'gia' => $giasp,  ]
        //     );
        // }

        // if($check != 0){
        //         DB::table('cart')
        //         ->where([
        //             ['iduser',$iduser],
        //             ['idproduct',$idsp],
        //         ])
        //         ->update(['soluong' => $soluong]);
        // }
        return redirect('/user/pages/pay/');
    }



    public function bill(){
        $iduser = Session::get('iduser');
        $bill = DB::table('cart')->where('iduser',$iduser)->get();
        // dd($iduser);
        return view('user.pages.bill',compact('bill'));
    }

    public function billStore(Request $request ,$idsp){
        $tinh = $request->tinh;
        Session::put('tinh', $tinh);

        $huyen = $request->huyen;
        Session::put('huyen', $huyen);

        $xa = $request->xa;
        Session::put('xa', $xa);

        $note = $request->note;
        Session::put('note', $note);

        $iduser = $request->iduser;
        Session::put('iduser', $iduser);
        $idsp= $request->idProduct;

        $check = DB::table('cart')->where([
            ['iduser',$iduser],
            ['idproduct',$idsp],
        ])->count();
        // dd($note);



        return redirect('/user/pages/bill/');

    }

    public function execPostRequest($url, $data){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momopay(Request $request){


        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";

        $amount = $request->momovnpay;
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/user/main
        ";

        $ipnUrl = "http://127.0.0.1:8000/user/pages/bill";
        $extraData = "";

            $requestId = time() . "";
            $requestType = "payWithATM";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result =$this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            // dd($jsonResult);
            //Just a example, please check more in there
            return redirect()->to($jsonResult['payUrl']);


    }




}
