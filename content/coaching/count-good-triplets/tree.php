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
            'message' => "Read the problem statement above.\nIndex order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i < j < k', 'next' => 's2'],
                ['label' => 'Any three indices', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Triplets are ordered by index.\nStep back to when you ignored order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prune where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never', 'next' => 'wrong_b'],
                ['label' => 'Before the k loop', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Failing pairs need no k loop.\nStep back to when you skipped pruning.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n ≤ 100?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n³) is fine', 'next' => 'success'],
                ['label' => 'Need O(n log n)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10^6 checks are fast.\nStep back to when you over-engineered.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). [3,0,1,1,9,7], 7, 2, 3 → 4. [1,1,2,2,3], 0, 0, 1 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
