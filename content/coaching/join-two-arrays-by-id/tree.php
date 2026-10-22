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
            'message' => "Read the problem statement above.\nAn id in both arrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge the two objects, arr2’s values winning', 'next' => 's2'],
                ['label' => 'Keep arr1’s object', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. arr2 must override; example 2 → id 2 with x: 3, y: 6 instead of x: 10, y: 20.\nStep back to when you kept arr1’s object.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A key like b holding an object in both?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge the nested objects too', 'next' => 'wrong_b'],
                ['label' => 'arr2’s whole value replaces it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The merge is shallow; in Node example 3 → b: {b: 94, c: 84} instead of b: {c: 84}.\nStep back to when you merged deeply.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Example 1 → ids 1, 2, 3 unchanged; example 2 → [{id: 1, x: 2, y: 3}, {id: 2, x: 10, y: 20}, {id: 3, x: 0, y: 0}]; example 3 → [{id: 1, b: {c: 84}, v: [1, 3], y: 48}].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
