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
            'message' => "Read the problem statement above.\nFind the next compatible event?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bisect_right on starts with end[i]', 'next' => 's2'],
                ['label' => 'bisect_left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. End days are inclusive, so a start equal to the end conflicts.\nStep back to when you used bisect_left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Greedy by value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, take the most valuable first', 'next' => 'wrong_b'],
                ['label' => 'No, use DP', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 needs two smaller events over one larger.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Table size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n · k, bounded by 10^6', 'next' => 'success'],
                ['label' => 'n · maxDay', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Days reach 10^9; index by event instead.\nStep back to when you indexed by day.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + n · k). Examples → 7, 10, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
