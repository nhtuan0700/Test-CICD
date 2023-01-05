<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use ReflectionClass;

class ReflectionTestController extends Controller
{
    public function index() {
        // $plan = Plan::FREE()->maximumMember();
        $plan = Plan::FREE()->maximumMember();
        return [
            'subject' => 'test reflection',
            'value' => $plan->value
        ];
    }
}