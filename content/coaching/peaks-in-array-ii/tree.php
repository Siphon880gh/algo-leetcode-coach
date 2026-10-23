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
            'message' => "Read the problem statement above.\nCount subarrays how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By their first interior peak', 'next' => 's2'],
                ['label' => 'Add each peak\'s own count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 3, 1, 3, 1], query [1, 0, 4] → 6 instead of 5.\nStep back to when you added per peak.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After an update, recheck?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only index', 'next' => 'wrong_b'],
                ['label' => 'index − 1, index and index + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [0, 2, 3], queries [[2, 2, 0], [1, 0, 2]] → [0] instead of [1].\nStep back to when you rechecked one index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [2, 0], [1, 0], [0, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
