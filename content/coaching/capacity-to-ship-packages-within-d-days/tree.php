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
            'message' => "Read the problem statement above.\nLowest capacity worth trying?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(weights)', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The heaviest package must fit on some day.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test capacity c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the weights, then pack', 'next' => 'wrong_b'],
                ['label' => 'Load in order, start a new day on overflow, count the days', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Packages ship in the given order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "days_needed(mid) ≤ days. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid', 'next' => 'success'],
                ['label' => 'lo = mid + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. mid works, so the answer is mid or smaller.\nStep back to when you raised lo.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log sum). [1,2,3,4,5,6,7,8,9,10], days = 5 → 15. [3,2,2,4,1,4], days = 3 → 6. [1,2,3,1,1], days = 4 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
