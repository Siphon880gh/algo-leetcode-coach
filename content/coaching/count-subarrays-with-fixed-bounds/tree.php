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
            'message' => "Read the problem statement above.\nAdd for each right end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(0, min(lastMin, lastMax) − bad)', 'next' => 's2'],
                ['label' => 'min(lastMin, lastMax) − bad', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A bound seen before the bad index makes it negative; Example 1 → −6 instead of 2.\nStep back to when you dropped the max with 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A value equal to both minK and maxK?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update only lastMin, with else-if', 'next' => 'wrong_b'],
                ['label' => 'Update lastMin and lastMax', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 0 instead of 10.\nStep back to when you used else-if.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width for the count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With minK = maxK and all values equal it is n(n + 1) / 2 ≈ 5 · 10^9.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
