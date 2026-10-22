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
            'message' => "Read the problem statement above.\nWhich averages bound the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every prefix average', 'next' => 's2'],
                ['label' => 'Only the whole array’s average', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Value cannot move right; Example 2 → 6 instead of 10.\nStep back to when you used only the whole array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Round each prefix average?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Down', 'next' => 'wrong_b'],
                ['label' => 'Up', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A prefix of 3 over 2 numbers forces a 2 somewhere; [1,2] → 1 instead of 2.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width for the sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sums reach 10^5 · 10^9 = 10^14.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
