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
            'message' => "Read the problem statement above.\nAfter change(i, x), the old heap still holds i. On find?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop tops whose index no longer holds the number', 'next' => 's2'],
                ['label' => 'Trust the heap top', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. After change(1, 20), find(10) → 1 instead of 2.\nStep back to when you trusted the top.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Store index → number in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An array of size 10^9 + 1', 'next' => 'wrong_b'],
                ['label' => 'A hash map', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Indices reach 10^9; that array needs gigabytes.\nStep back to when you used an array.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "find with an empty heap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The Example’s first find → 0 instead of −1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) amortised per call. Example → null, −1, null, null, null, null, 1, null, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
