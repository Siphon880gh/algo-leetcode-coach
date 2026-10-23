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
            'message' => "Read the problem statement above.\nTotal cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n(n − 1) / 2', 'next' => 's2'],
                ['label' => 'n − 1, one per split', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you counted splits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Does the first split cover everything?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, ⌊n / 2⌋ · ⌈n / 2⌉', 'next' => 'wrong_b'],
                ['label' => 'No, sum every split', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 4 instead of 6.\nStep back to when you stopped after one split.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 3, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
