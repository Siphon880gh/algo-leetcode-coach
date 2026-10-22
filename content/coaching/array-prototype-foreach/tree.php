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
            'message' => "Problem: Add a forEach method to every array without using the built-in one. It takes a callback and a context object, and calls the callback for each element with the element, its index and the array, with this set to the context. The exact argument order and limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nLoop over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices 0 … length − 1', 'next' => 's2'],
                ['label' => 'for … in over the array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It also visits enumerable prototype methods; in Node it calls back for fe too.\nStep back to when you used for … in.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Invoke the callback with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'callback(value, i, this)', 'next' => 'wrong_b'],
                ['label' => 'callback.call(context, value, i, this)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. this is lost; in Node the check gives NaN values.\nStep back to when you dropped the context.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → [2, 4, 6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
