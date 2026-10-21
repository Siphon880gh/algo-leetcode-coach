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
            'message' => "Read the problem statement above.\nTwin of node i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node n − 1 − i', 'next' => 's2'],
                ['label' => 'Node i + n / 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. For n = 4, node 0 pairs with node 3; Example 2 → 7 from 4 + 3.\nStep back to when you shifted by n / 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair them in O(1) extra space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk from both ends', 'next' => 'wrong_b'],
                ['label' => 'Reverse the second half and walk both halves', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A singly linked list cannot be walked backwards.\nStep back to when you walked from the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest twin sum', 'next' => 'success'],
                ['label' => 'The sum of all twin sums', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 6.\nStep back to when you added them all.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) extra. Examples → 6, 7, 100001.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
