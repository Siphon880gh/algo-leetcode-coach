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
            'message' => "Problem: You get an array of objects (or arrays) that may be nested and may hold numbers, strings, booleans and null. Build a matrix: the first row lists column names, which are the paths from each object’s root to its leaf values, and each later row holds one object’s value for every column, with an empty marker where the object has no value. How paths are written, the column order and the empty marker are in the official statement. For instance, two objects with keys b and a and no nesting give the header a, b followed by one row per object. (Restated from memory; limits and examples may differ slightly.)\nA null value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record it as a leaf', 'next' => 's2'],
                ['label' => 'Recurse into it as an object', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. typeof null is object, but it has no keys; in Node Object.keys(null) → a TypeError.\nStep back to when you recursed into null.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Header paths come from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first object only', 'next' => 'wrong_b'],
                ['label' => 'The union over all objects', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later objects can add paths; {a: 1} and {b: 2} → header a only instead of a, b.\nStep back to when you used one object.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total size + columns · objects). Constructed checks (run in Node) → as in the guide.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
