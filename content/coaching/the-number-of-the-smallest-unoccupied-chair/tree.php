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
            'message' => "Read the problem statement above.\nRelease condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'leave ≤ arrival', 'next' => 's2'],
                ['label' => 'leave < arrival', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A chair freed at that moment is available.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Free chairs stored in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A queue', 'next' => 'wrong_b'],
                ['label' => 'A min-heap', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A queue returns the oldest, not the smallest.\nStep back to when you used a queue.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Processing order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By arrival time', 'next' => 'success'],
                ['label' => 'By friend index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Seating depends on time.\nStep back to when you used index order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
