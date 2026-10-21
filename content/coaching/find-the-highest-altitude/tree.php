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
            'message' => "Read the problem statement above.\nInitial best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0, the starting altitude', 'next' => 's2'],
                ['label' => 'gain[0]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The start point counts and may be the highest.\nStep back to when you started from gain[0].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare, then add', 'next' => 'wrong_b'],
                ['label' => 'Add the gain, then compare', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Comparing first misses the final point.\nStep back to when you compared first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Extra array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed', 'next' => 'success'],
                ['label' => 'Store all altitudes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One running value suffices.\nStep back to when you stored them all.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1). Examples → 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
