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
            'message' => "Read the problem statement above.\nExpand the encoding into a list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: counts reach 10⁹', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That cannot fit in memory.\nStep back to when you expanded it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The current run has fewer than n items. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'wrong_b'],
                ['label' => 'Subtract its count from n and move to the next run', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The remaining items can come from later runs.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The current run has at least n items. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract n from its count and return its value', 'next' => 'success'],
                ['label' => 'Move to the next run', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The n-th item is in this run.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) amortized per call. [3,8,0,9,2,5]: next(2) → 8, next(1) → 8, next(1) → 5, next(2) → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
