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
            'message' => "Read the problem statement above.\nTrack what along a path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts of factors 2 and 5', 'next' => 's2'],
                ['label' => 'The product itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Seven values of 1000 already pass 10^21, beyond 64-bit.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shapes to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Straight rows and columns only', 'next' => 'wrong_b'],
                ['label' => 'Every corner with one horizontal and one vertical arm', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 needs a turn; straight paths → 2 instead of 3.\nStep back to when you skipped turns.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Corner cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it once', 'next' => 'success'],
                ['label' => 'Add it with both arms', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 4 instead of 3.\nStep back to when you counted the corner twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n) with prefix sums. Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
