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
            'message' => "Read the problem statement above.\nobj1 + obj2 should use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'valueOf returning the sum', 'next' => 's2'],
                ['label' => 'toString only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. + then joins strings; in Node example 1 → [1,2][3,4] instead of 10.\nStep back to when you defined only toString.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum of an empty array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'reduce with no initial value', 'next' => 'wrong_b'],
                ['label' => 'reduce with initial value 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 needs 0; in Node reducing [] with no initial value → a TypeError.\nStep back to when you dropped the initial value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) per conversion. Examples (run in Node) → 10, [23,98,42,70], 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
