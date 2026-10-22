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
            'message' => "Read the problem statement above.\nSubtract how many safe outcomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2: all clockwise or all counterclockwise', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Both directions are safe; Example 1 → 7 instead of 6.\nStep back to when you subtracted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After pow(2, n) mod M − 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return it', 'next' => 'wrong_b'],
                ['label' => 'Add M, then mod again', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The power can reduce to 1; n = 500000003 → −1 instead of 10^9 + 6.\nStep back to when you returned a negative.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → 6, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
