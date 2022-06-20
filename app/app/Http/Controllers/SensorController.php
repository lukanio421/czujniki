<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Measurement;

class SensorController extends Controller
{
    const ITEMS_PER_PAGE = 15;

    public function getSenorMeasurements(string $page = null) : View
    {
        $content = null;
        if (Storage::disk('public')->exists('results.json'))
        {
            $content = json_decode(Storage::disk('public')->get('results.json'), true);
        }

        if (is_null($content)) return view('sensor.alert');
        $pagination = $this->customPaginate($content, $page);

        return view('sensor.sensor', [
        'pagination' => $pagination]);
    }

    private function customPaginate(array $content = null, string $page = null) : array
    {
        $parts = count($content)/self::ITEMS_PER_PAGE;
        $pagination = $parts + 1;

        if (is_null($page) || $page == 1)
        {
            $page = 1;
            $offset = ($page - 1) * self::ITEMS_PER_PAGE;
            $content = array_slice($content, $offset , self::ITEMS_PER_PAGE, true);
            $prev = 1;
            $next = 2;
        }

        if (!is_null($page) && $page != 1)
        {
            $offset = ($page - 1) * self::ITEMS_PER_PAGE;
            $content = array_slice($content, $offset , self::ITEMS_PER_PAGE, true);
            $prev = $page - 1;
            $next = $prev + 2;
        }

        if ($page == $parts)
        {
            $next = $page;
        }

        return [
            'content' => $content,
            'pagination' => $pagination,
            'page' => $page,
            'prev' => $prev,
            'next' => $next
        ];
    }
}
