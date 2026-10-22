<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: Add a method to every function that takes an object and returns a new function. Calling the new function runs the original with that object as this and passes along all arguments. You may not use the built-in bind. The method name and examples are in the official statement. For instance, binding function f(m) { return this.ctx + \"-\" + m } to {ctx: \"A\"} and calling it with \"x\" gives A-x. (Restated from memory; limits and examples may differ slightly.)\nDefine the method with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'function (obj) { … }', 'next' => 's2'],
                ['label' => 'An arrow function', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An arrow’s this is not the function; in Node the call throws a TypeError.\nStep back to when you used an arrow.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Call the original with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'apply(obj) with no arguments', 'next' => 'wrong_b'],
                ['label' => 'apply(obj, args), forwarding every argument', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Arguments are lost; in Node the example → A-undefined instead of A-x.\nStep back to when you dropped the arguments.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. The example → A-x.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
