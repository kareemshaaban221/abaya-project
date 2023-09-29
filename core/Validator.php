<?php

namespace Core;

use Closure;

class Validator {
    public static function condition($rule): Closure {
        $rule_details = explode(':', $rule);
        $request = (new Request);
        switch ($rule_details[0]) {
            case 'required':
                return function ($input) use ($request) {
                    $input = $request->get($input);
                    return $input == '' || !$input;
                };
            case 'min':
                return function ($input) use ($request, $rule_details) {
                    $input = $request->get($input);
                    return strlen($input) < intval($rule_details[1]);
                };
            case 'confirmed':
                return function ($input) use ($request) {
                    return !$request->has("{$input}_confirmation") ||
                        $request->get("{$input}") != $request->get("{$input}_confirmation");
                };
            case 'file':
                return function ($input) use ($request) {
                    return !$request->file($input);
                };
            case 'max_size':
                return function ($input) use ($request, $rule_details) {
                    return ($request->file($input)['size'] ?? 0) > intval($rule_details[1]) * 1000;
                };
            default:
                return function ($input='') {
                    return false;
                };
        }
    }

    public static function message($rule, $input) {
        $rule_details = explode(':', $rule);
        switch ($rule_details[0]) {
            case 'required':
                return "هذا الحقل مطلوب.";
            case 'min':
                return "هذا الحقل يجب الا يقل عن $rule_details[1] احرف.";
            case 'confirmed':
                return "تأكيد كلمة المرور ليس مطابقا لكلمة المرور هذه.";
            case 'file':
                return "هذا الحقل يجب ان يكون ملف.";
            case 'max_size':
                return "حجم الملف تجاوز الحد المسموح به.";
            default:
                return "البيانات المدخلة غير مسموح بها.";
        }
    }
}
