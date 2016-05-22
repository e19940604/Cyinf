<?php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CyinfApiController extends Controller
{
    protected $dataRule;
    protected $responseData;
    protected $responseCode;

    public function __construct(){
        $this->dataRule = [];
        $this->responseData = [];
        $this->responseData['status'] = 'failure';
        $this->responseCode = 500;
    }

    /**
     * Vaild data format
     * @param  array $data     Need vaild data array.
     * @param  array $required Need required filed.
     * @return true|string
     */
    protected function vaild_data_format($data, $required = []){

        foreach ($required as $value) {
            if(isset($this->dataRule[$value]))
                $this->dataRule[$value] = 'required|'.$this->dataRule[$value];
            else $this->dataRule[$value] = 'required';
        }

        $validator = \Validator::make($data, $this->dataRule);

        if($validator->fails()){
            return $validator->errors()->first();
        }

        return true;
    }

    /**
     * Control response
     * @return Response-json
     */
    protected function send_response(){

        if($this->responseCode == 500){
            $this->responseData['error'] = 'Oops! Something went wrong. Please try again later.';
        }
        else if($this->responseCode == 200){
            $this->responseData['status'] = 'success';
        }

        return response()->json($this->responseData, $this->responseCode);
    }
}
