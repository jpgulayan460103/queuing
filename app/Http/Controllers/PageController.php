<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriorityNumber;
use PDF;

class PageController extends Controller
{
    public function printNumber(Request $request)
    {
        $priority_number = new PriorityNumber;
        switch ($request->category) {
            case 'regular':
            case 'vip':
            case 'senior_pwd':
            case 'customer_service':
                $type = $request->type;
                break;
            
            default:
                $category = "regular";
                break;
        }
        switch ($request->type) {
            case 'pay in':
            case 'payout':
                $category = $request->category;
                break;
            default:
                $category = "pay in";
                break;
        }
        $last_number = PriorityNumber::where('category', $category)->where('type',$type)->orderBy('id','desc')->first();
        if($last_number){
            $priority_number->priority_number = $last_number->priority_number + 1;
        }else{
            $priority_number->priority_number = 1;
        }
        $priority_number->type = $type;
        $priority_number->category = $category;
        $priority_number->save();

        $data['priority_number'] = $priority_number;
        return view('print',$data);

        $pdf = PDF::setOptions(['dpi' => 600, 'defaultFont' => 'Helvetica']);
        $pdf->setPaper(array(0,0,140,400), 'portrait');
        $pdf->loadView('print', $data);
        return $pdf->stream('asd.pdf');
    }

    public function getCurrentNumbers(Request $request)
    {
        $regular_pay_in = PriorityNumber::where('category','regular')->where('type','pay in')->orderBy('id','desc')->first();
        $regular_pay_in = $regular_pay_in ? $regular_pay_in->priority_number : 0;

        $vip_pay_in = PriorityNumber::where('category','vip')->where('type','pay in')->orderBy('id','desc')->first();
        $vip_pay_in = $vip_pay_in ? $vip_pay_in->priority_number : 0;

        $senior_pwd_pay_in = PriorityNumber::where('category','senior_pwd')->where('type','pay in')->orderBy('id','desc')->first();
        $senior_pwd_pay_in = $senior_pwd_pay_in ? $senior_pwd_pay_in->priority_number : 0;


        $regular_payout = PriorityNumber::where('category','regular')->where('type','payout')->orderBy('id','desc')->first();
        $regular_payout = $regular_payout ? $regular_payout->priority_number : 0;

        $vip_payout = PriorityNumber::where('category','vip')->where('type','payout')->orderBy('id','desc')->first();
        $vip_payout = $vip_payout ? $vip_payout->priority_number : 0;

        $senior_pwd_payout = PriorityNumber::where('category','senior_pwd')->where('type','payout')->orderBy('id','desc')->first();
        $senior_pwd_payout = $senior_pwd_payout ? $senior_pwd_payout->priority_number : 0;



        $customer_service = PriorityNumber::where('category','customer_service')->orderBy('id','desc')->first();
        $customer_service = $customer_service ? $customer_service->priority_number : 0;
        $data = [
            'regular' => ['pay_in' => sprintf('%03d',$regular_pay_in), 'payout' => sprintf('%03d',$regular_payout)],
            'vip' => ['pay_in' => sprintf('%03d',$vip_pay_in), 'payout' => sprintf('%03d',$vip_payout)],
            'senior_pwd' => ['pay_in' => sprintf('%03d',$senior_pwd_pay_in), 'payout' => sprintf('%03d',$senior_pwd_payout)],
            'customer_service' => sprintf('%03d',$customer_service)
        ];
        return $data;
    }
}
