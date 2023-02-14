<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

if (! function_exists('getErrorMessages')) {
    function getErrorMessages($messages)
    {
        $errorMessages = [];
        foreach ($messages as $key => $values) {
            foreach ($values as $index => $value) {
                array_push($errorMessages, $value);
            }
        }

        return $errorMessages;
    }
}

if (! function_exists('generalErrorResponse')) {
    function generalErrorResponse(Exception $e)
    {
        return response()->json([
            'messages' => [$e->getMessage()],
            'trace' => [$e->getTrace()],
        ], 400);
    }
}

if (! function_exists('paginate')) {
    function paginate($items, $perPage = 100, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

if (! function_exists('isExternalSystemUser')) {
    function isExternalSystemUser()
    {
        if (! Auth::user()) {
            return false;
        }

        return in_array('External System', Auth::user()->roles->pluck('name')->toArray());
    }
}
