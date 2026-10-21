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
            'message' => "Read the problem statement above.\nTry every choice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: track reachable sums row by row', 'next' => 's2'],
                ['label' => 'Yes, enumerate all combinations', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 70 rows of 70 choices is 70^70 combinations.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sums above target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop them all', 'next' => 'wrong_b'],
                ['label' => 'Keep only the smallest one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The best sum can be above target; Example 3 is answered by 7 against target 6.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pick each row's element closest to target / m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, keep the set of sums', 'next' => 'success'],
                ['label' => 'Yes, greedy per row', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rows interact; only the full set of sums is safe.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · target). Examples → 0, 94, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
