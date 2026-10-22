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
            'message' => "Read the problem statement above.\nStore what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sums of adjacent pairs', 'next' => 's2'],
                ['label' => 'The values themselves', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A repeated value is not a repeated sum; [1,1,2] → true instead of false.\nStep back to when you stored values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Do overlapping pairs count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, they must be disjoint', 'next' => 'wrong_b'],
                ['label' => 'Yes, they start at different indices', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → false instead of true.\nStep back to when you required disjoint pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Check against the set when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before adding the current sum', 'next' => 'success'],
                ['label' => 'After adding it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every sum finds itself; Example 2 → true instead of false.\nStep back to when you added first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
