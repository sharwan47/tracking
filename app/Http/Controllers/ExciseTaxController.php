<?php

namespace App\Http\Controllers;
use QuickBooksOnline\API\DataService\DataService;
use App\Models\ExciseTax;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Session;

class ExciseTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $dataService = DataService::Configure(array(
        'auth_mode' => 'oauth2',
        'ClientID' => env('QUICKBOOKS_CLIENT_ID'),
        'ClientSecret' =>  env('QUICKBOOKS_CLIENT_SECRET'),
        'RedirectURI' => env('oauth_redirect_uri'),
        'scope' => env('oauth_scope'),
        'baseUrl' => "development"
    ));

     $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
// print_r($OAuth2LoginHelper); exit;
// $authUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
     $authUrl = '';

// Store the url in PHP Session Object;
     $_SESSION['authUrl'] = $authUrl;

//set the access token using the auth object
     if (isset($_SESSION['sessionAccessToken'])) {

        $accessToken = $_SESSION['sessionAccessToken'];
        $accessTokenJson = array('token_type' => 'bearer',
            'access_token' => $accessToken->getAccessToken(),
            'refresh_token' => $accessToken->getRefreshToken(),
            'x_refresh_token_expires_in' => $accessToken->getRefreshTokenExpiresAt(),
            'expires_in' => $accessToken->getAccessTokenExpiresAt()
        );
        $dataService->updateOAuth2Token($accessToken);
        $oauthLoginHelper = $dataService -> getOAuth2LoginHelper();
        $CompanyInfo = $dataService->getCompanyInfo();
        print_r($CompanyInfo); exit;
    }




    if(Auth::user()->role_id == 2){
    $excisetaxs =ExciseTax::join('users','excise_taxes.persion_id','=','users.id')
    ->select('users.first_name','users.last_name','excise_taxes.*')
    ->where('excise_taxes.user_id','=',Auth::user()->id)->get(); 
    return view('excisetax.index',compact('excisetaxs'));
   }else
   {
     $excisetaxs =ExciseTax::join('users','excise_taxes.persion_id','=','users.id')
    ->select('users.first_name','users.last_name','excise_taxes.*')
    ->where('excise_taxes.persion_id','=',Auth::user()->id)->get(); 
    return view('excisetax.index',compact('excisetaxs'));
   }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $users = User::where('role_id','=',3)->where('user_id','=',Auth::user()->id)->get();
       return view('excisetax.create',compact('users'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $ExciseTax = new ExciseTax;
        $ExciseTax->create($data);
        return redirect('ExciseTax')->with('message','Thank You, Your Process Is Complete Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExciseTax  $exciseTax
     * @return \Illuminate\Http\Response
     */
    public function show(ExciseTax $exciseTax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExciseTax  $exciseTax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('role_id','=',3)->where('user_id','=',Auth::user()->id)->get();
       $excisetax =ExciseTax::find($id); 
       return view('excisetax.edit',compact('excisetax','users'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExciseTax  $exciseTax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

      if($request->IFTATaxPaid)
        {$IFTATaxPaid = $request->IFTATaxPaid;}else{$IFTATaxPaid = '';};

    if($request->IFTATaxPayment)
        {$IFTATaxPayment = $request->IFTATaxPayment;}else{$IFTATaxPayment = '';};

    if($request->SecondIFTATaxPaid)
        {$SecondIFTATaxPaid = $request->SecondIFTATaxPaid;}else{$SecondIFTATaxPaid = '';};

    if($request->SecondIFTATaxPayment)
        {$SecondIFTATaxPayment = $request->SecondIFTATaxPayment;}else{$SecondIFTATaxPayment = '';};

    if($request->PaymentMode)
        {$PaymentMode = $request->PaymentMode;}else{$PaymentMode = '';};
    if($request->PaymentConformed)
        {$PaymentConformed = $request->PaymentConformed;}else{$PaymentConformed = '';};
    if($request->FormSchedule)
        {$FormSchedule = $request->FormSchedule;}else{$FormSchedule = '';};

    if($request->ThirdIFTATaxPaid)
        {$ThirdIFTATaxPaid = $request->ThirdIFTATaxPaid;}else{$ThirdIFTATaxPaid = '';};
    if($request->ThirdIFTATaxPayment)
        {$ThirdIFTATaxPayment = $request->ThirdIFTATaxPayment;}else{$ThirdIFTATaxPayment = '';};

    if($request->FourthIFTATaxPaid)
        {$FourthIFTATaxPaid = $request->FourthIFTATaxPaid;}else{$FourthIFTATaxPaid = '';};

    if($request->FourthIFTATaxPayment)
        {$FourthIFTATaxPayment = $request->FourthIFTATaxPayment;}else{$FourthIFTATaxPayment = '';};



    $data = $request->all();

    $data['IFTATaxPaid'] = $IFTATaxPaid;
    $data['IFTATaxPayment'] = $IFTATaxPayment;
    $data['SecondIFTATaxPaid'] = $SecondIFTATaxPaid;
    $data['SecondIFTATaxPayment'] = $SecondIFTATaxPayment;
    $data['PaymentMode'] = $PaymentMode;
    $data['PaymentConformed'] = $PaymentConformed;
    $data['FormSchedule'] = $FormSchedule;
    $data['ThirdIFTATaxPaid'] = $ThirdIFTATaxPaid;
    $data['ThirdIFTATaxPayment'] = $ThirdIFTATaxPayment;
    $data['FourthIFTATaxPaid'] = $FourthIFTATaxPaid;
    $data['FourthIFTATaxPayment'] = $FourthIFTATaxPayment;
    $ExciseTax = ExciseTax::find($id);
    $ExciseTax->update($data);
    return redirect('ExciseTax')->with('message','Thank You, Your Process Is Complete Successfully');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExciseTax  $exciseTax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $ExciseTax = ExciseTax::find($id);
     $ExciseTax->delete();
     return redirect('ExciseTax')->with('message','Thank You, Your Process Is Complete Successfully');
 }

 public function IftaPaymentConformedUpdate(Request $request)
    {
       $EstimatePaymentMode = ExciseTax::where('id','=',$request->id)->first();
       $EstimatePaymentMode->IFTATaxPayment = $request->val;
       $EstimatePaymentMode->save();
       return redirect('EstimatePayment')->with('message','Thank You, Your Process Is Complete Successfully');
    }


}
