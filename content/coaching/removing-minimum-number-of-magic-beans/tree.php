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
            'message' => "Read the problem statement above.\nWhich levels to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each bag size after sorting', 'next' => 's2'],
                ['label' => 'Only the average size', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 average is 4, which works there, but [1,1,10] → 2 at level 10, while the average 4 needs 8.\nStep back to when you used the average.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bags smaller than the level?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them as they are', 'next' => 'wrong_b'],
                ['label' => 'Empty them completely', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every non-empty bag must match; Example 1 at level 6 would cost 0 while bags 1, 4, 5 still differ.\nStep back to when you ignored the smaller bags.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Totals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10^5 bags of up to 10^5 beans reach 10^10.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 4, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
