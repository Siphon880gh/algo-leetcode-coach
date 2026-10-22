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
            'message' => "Problem: Given a function fn, return its curried version: a function that can be called with the arguments in any grouping, across several calls, and that calls fn once it has received as many arguments as fn expects (fn.length). The exact rules and examples are in the official statement. For instance, with sum3 = (a, b, c) => a + b + c, curry(sum3)(1)(2)(3), curry(sum3)(1, 2)(3) and curry(sum3)(1)(2, 3) all give 6. (Restated from memory; limits and examples may differ slightly.)\nWhen to call fn?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the count reaches fn.length', 'next' => 's2'],
                ['label' => 'When the count exceeds fn.length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Three arguments are enough for sum3; curry(sum3)(1)(2)(3) → a function instead of 6.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where do new arguments go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pushed onto one shared array', 'next' => 'wrong_b'],
                ['label' => 'A new array: the old ones plus the new', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Branches share the list; p = curry(sum3)(1), p(2)(3) → 6, then p(10) → 6 instead of a function waiting for one more argument.\nStep back to when you shared the array.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total arguments) per completed call. Constructed checks (run in Node) → 6 for each grouping.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
