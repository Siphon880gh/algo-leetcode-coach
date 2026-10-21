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
            'message' => "Read the problem statement above.\nEnumerate all choices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n^m is huge', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 40 columns and 40 rows explode.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why keep only k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Approximate heuristic', 'next' => 'wrong_b'],
                ['label' => 'Later rows only add; ranks beyond k stay beyond k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Truncation is exact.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sums[k−1] after the last row', 'next' => 'success'],
                ['label' => 'sums[0]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is the smallest, not the k-th.\nStep back to when you returned sums[0].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [[1,3,11],[2,4,6]], k = 5 → 7; k = 9 → 17. [[1,10,10],[1,4,5],[2,3,6]], k = 7 → 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
