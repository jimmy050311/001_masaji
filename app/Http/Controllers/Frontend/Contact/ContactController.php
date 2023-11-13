<?php

namespace App\Http\Controllers\Frontend\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\Contact\ContactService;
use Illuminate\Http\Request;
use Exception;

class ContactController extends Controller
{
    private $service;

    public function __construct(ContactService $service)
    {
        $this->service = $service;
    }

    public function store(ContactRequest $request)
    {
        try {

            $this->service->add($request->all());

            $response = [
                'success' => 200,
                'message' => '傳送成功',
            ];

        }catch(Exception $e){
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }
}
