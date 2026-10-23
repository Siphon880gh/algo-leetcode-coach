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
            'message' => "Read the problem statement above.\nOrder rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best over every allowed next node (DP)', 'next' => 's2'],
                ['label' => 'Always place the smallest available score', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 3, edges [[0, 1]], score = [7, 2, 6] → 26 instead of 29.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Position of the next node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'popcount(mask)', 'next' => 'wrong_b'],
                ['label' => 'popcount(mask) + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 instead of 8.\nStep back to when you counted from 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n). Examples → 8, 25.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
