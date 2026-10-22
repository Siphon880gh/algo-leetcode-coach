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
            'message' => "Read the problem statement above.\nArguments to fn?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr[i] and i', 'next' => 's2'],
                ['label' => 'arr[i] only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. plusI needs the index; Example 2 → [NaN,NaN,NaN] instead of [1,3,5].\nStep back to when you dropped i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How to loop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'for (const i in arr)', 'next' => 'wrong_b'],
                ['label' => 'for (let i = 0; i < n; i++)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. for…in gives string keys; Example 2 → string results 10, 21, 32 instead of [1,3,5].\nStep back to when you used for…in.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2,3,4], [1,3,5], [42,42,42].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
