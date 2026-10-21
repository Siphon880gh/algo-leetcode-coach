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
            'message' => "Read the problem statement above.\nAverage?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sum // size, rounded down', 'next' => 's2'],
                ['label' => 'Exact: sum = val · size', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Node 5 has (5 + 6) / 2 = 5 after rounding; Example 1 → 4 instead of 5.\nStep back to when you required an exact average.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Over which nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole tree', 'next' => 'wrong_b'],
                ['label' => 'The node’s own subtree', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 5.\nStep back to when you used the whole tree.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Include the node itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, in sum and size', 'next' => 'success'],
                ['label' => 'No, only its descendants', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leaves have no descendants; Example 1 → 1 instead of 5.\nStep back to when you left the node out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
