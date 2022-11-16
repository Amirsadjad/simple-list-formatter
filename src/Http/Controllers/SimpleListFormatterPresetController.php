<?php

namespace Amirsadjad\SimpleListFormatter\Http\Controllers;

use Amirsadjad\SimpleListFormatter\Models\SimpleListPresets;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SimpleListFormatterPresetController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(SimpleListPresets::all());
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function show(string $name)
    {
        return response()->json(SimpleListPresets::findOrFail($name));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:simple_list_formatter_presets,name',
            'data' => 'required'
        ]);

        return response()->json(SimpleListPresets::create($data));
    }

    /**
     * @param $name
     * @param Request $request
     * @return JsonResponse
     */
    public function update($name, Request $request)
    {
        $data = $request->validate([
            'data' => 'required'
        ]);

        $simpleListFormatter = SimpleListPresets::findOrFail($name);
        $simpleListFormatter->update($data);

        return response()->json($simpleListFormatter);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function destroy(string $name)
    {
        $simpleListPreset = SimpleListPresets::findOrFail($name)->delete();
        return SimpleListPresets::all();
    }
}
