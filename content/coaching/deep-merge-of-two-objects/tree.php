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
            'message' => "Problem: Given two JSON-like values, return their deep merge: where both hold containers that can be combined, merge them key by key, recursively; otherwise the second value wins. How arrays and mixed types are handled, and the examples, are in the official statement. For instance, merging {a: 1, c: {x: 1}} with {b: 2, c: {y: 2}} gives {a: 1, b: 2, c: {x: 1, y: 2}}, and merging {a: 1} with {a: {z: 1}} gives {a: {z: 1}}. (Restated from memory; limits and examples may differ slightly.)\nMerge with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A recursive merge', 'next' => 's2'],
                ['label' => 'Object.assign', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is shallow; in Node the first example → c: {y: 2} instead of {x: 1, y: 2}.\nStep back to when you used Object.assign.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First is an object, second is a number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the object', 'next' => 'wrong_b'],
                ['label' => 'The second value wins', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only two containers merge; in Node merging {a: {z: 1}} with {a: 1} → {a: {z: 1}} instead of {a: 1}.\nStep back to when you kept the object.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total size). The examples → {a: 1, b: 2, c: {x: 1, y: 2}}, {a: {z: 1}}.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
