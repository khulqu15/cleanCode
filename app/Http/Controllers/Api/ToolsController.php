<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tools;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class ToolsController extends Controller
{

    private $tools;

    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }

    public function index()
    {
        $tools = $this->tools->paginate();
        return $this->onSuccess(true, $tools);
    }

    public function create() { }

    public function store(Request $request)
    {
        try {
            $tool = $this->tools->create($request->all());
            return $this->onSuccess(true, $tool);
        } catch (\Exception $e) {
            return $this->onFailure($e);
        }
    }

    public function show($id)
    {
        $tool = Tools::find($id);
        return $this->onSuccess(true, $tool);
    }

    public function edit(Tools $tools) { }

    public function update(Request $request, $id)
    {
        try {
            $tool = $this->tools->where('id', $id)->update($request->all());
            $mTool = Tools::find($id);
            return $this->onSuccess(true, $mTool);
        } catch (\Exception $e) {
            return $this->onFailure($e);
        }
    }

    public function destroy($id)
    {
        try {
            $tool = $this->tools->destroy($id);
            return $this->onSuccess(true, 'Deleted');
        } catch (\Exception $e) {
            return $this->onFailure($e);
        }
    }

    private function onSuccess($status, $data) {
        return response()->json([
            'success' => $status,
            'data' => $data
        ]);
    }

    private function onFailure(\Exception $e) {
        if($e instanceof ClientException) {
            $newException = json_decode($e->getResponse()->getBody()->getContents(), true);
            if($newException) {
                $e = new \Exception($newException['reason'], $newException['code']);
            }
        }
        $arr = [
            'error' => $e->getMessage(),
            'code' => $e->getCode()
        ];

        return response()->json($arr);
    }
}
