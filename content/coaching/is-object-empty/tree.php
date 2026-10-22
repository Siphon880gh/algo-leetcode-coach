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
            'message' => "Read the problem statement above.\nTest emptiness how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'for…in, returning false on the first key', 'next' => 's2'],
                ['label' => 'obj.length === 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Plain objects have no length; in Node example 2 → false instead of true.\nStep back to when you checked length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An array like [null, false, 0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore falsy values', 'next' => 'wrong_b'],
                ['label' => 'It has keys, so it is not empty', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Falsy values still occupy keys; example 3 → true instead of false.\nStep back to when you dropped falsy values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → false, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
