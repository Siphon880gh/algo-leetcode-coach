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
            'message' => "Read the problem statement above.\nA boundary between i − 1 and i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add min(i, n − i)', 'next' => 's2'],
                ['label' => 'Always flip the prefix, adding i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A suffix flip is cheaper on the right half; example 2 → 15 instead of 9.\nStep back to when you always flipped the prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Store the total in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 32-bit integer', 'next' => 'wrong_b'],
                ['label' => 'A 64-bit integer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An alternating string of length 10^5 costs 2,500,000,000, past 2^31 − 1.\nStep back to when you chose 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
