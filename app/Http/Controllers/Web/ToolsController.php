<?php

namespace App\Http\Controllers\Web;

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
        return view('tools.index', compact('tools'));
    }

    public function create()
    {
        return view('tools.form');
    }

    public function store(Request $request)
    {
        try {
            $this->tools->create($request->all());
            return redirect()->route('tools.index')->with('status', 'Success created');
        } catch (\Exception $e) {
            return $this->exception($e);
        }
    }

    public function show($id)
    {
        $tool = Tools::find($id);
        return view('tools.detail', compact('tool'));
    }

    public function edit($id)
    {
        $tool = Tools::find($id);
        return view('tools.form', compact('tool'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->tools->where('id', $id)->update($request->except(['_token', '_method']));
            return redirect()->route('tools.index')->with('status', 'Success Updated');
        } catch (\Exception $e) {
            return $this->exception($e);
        }
    }

    public function destroy($id)
    {
        try {
            $this->tools->destroy($id);
            return redirect()->route('tools.index')->with('status', 'Deleted');
        } catch (\Exception $e) {
            return $this->exception($e);
        }
    }

    private function exception(\Exception $e) {
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
        return var_dump($arr);
    }
}
