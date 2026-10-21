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
            'message' => "Read the problem statement above.\nSum |i − j| for each i directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prefix sums inside each value group', 'next' => 's2'],
                ['label' => 'Yes, over the other indices with the same value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 10^5 equal values make that about 10^10 steps.\nStep back to when you summed pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For index p, the k-th of m in its group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(sum after) − (sum before)', 'next' => 'wrong_b'],
                ['label' => 'k · p − (sum before) + (sum after) − (m − k − 1) · p', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each side needs its count times p; in Example 1, index 2 (value 3 at 2, 5, 6) would get 11 instead of 7.\nStep back to when you dropped the counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Result type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Totals reach about 5 · 10^9.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [4,2,7,2,4,4,5], [5,0,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
