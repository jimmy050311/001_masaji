<?php

namespace App\Http\Controllers\Backend\Event;

use App\Services\Event\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    private $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {

            $data = $this->service->searchAll($request->all());
            $dataPage = (int)$this->service->total((int)$request->paginate);

            $response = [
                'success' => 200,
                'message' => '成功',
                'dataPage' => $dataPage,
                'data' => EventResource::collection($data)
            ];
        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function store(EventRequest $request): JsonResponse
    {
        try {
            
            $this->service->add($request->all());

            $response = [
                'success' => 200,
                'message' => '新增成功',
            ];
            
        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function show($id) 
    {
        try {

            $data = $this->service->searchById($id);

            $response = [
                'success' => 200,
                'message' => '成功',
                'data' => new EventResource($data)
            ];

        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, $response['success']);
    }

    public function update(EventRequest $request, $id) 
    {
        try {

            $this->service->edit($id, $request->all());

            $response = [
                'success' => 200,
                'message' => '修改成功'
            ];
        }catch(Exception $e) {
            $response = [
                'success' => 400,
                'message' => $e->getMessage()
            ];  
        }

        return response()->json($response, $response['success']);
    }
}
