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
            'message' => "Problem: Given an array of keys and an array of values, return an object that maps each key to the value at the same index. How a repeated key is handled is in the official statement. For instance, keys [a, b] with values [1, 2] give {a: 1, b: 2}. (Restated from memory; limits and examples may differ slightly.)\nA key is already in the object?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 's2'],
                ['label' => 'Assign again', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Under the first-occurrence assumption the later value overwrites; in Node [a, b, a] with [1, 2, 3] → {a: 3, b: 2}.\nStep back to when you assigned again.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test presence with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whether r[key] is truthy', 'next' => 'wrong_b'],
                ['label' => 'key in r', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Falsy values look absent; in Node [a, a] with [0, 5] → {a: 5} instead of {a: 0}.\nStep back to when you tested truthiness.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example → {a: 1, b: 2}.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
