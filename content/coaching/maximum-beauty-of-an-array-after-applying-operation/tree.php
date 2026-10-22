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
            'message' => "Read the problem statement above.\nBefore sliding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort nums', 'next' => 's2'],
                ['label' => 'Keep the original order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The chosen elements need not be adjacent; unsorted, example 1 → 4 instead of 3.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The window is valid while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[r] − a[l] ≤ k', 'next' => 'wrong_b'],
                ['label' => 'a[r] − a[l] ≤ 2k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both ends move by k; example 1 → 2 instead of 3.\nStep back to when you used k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
