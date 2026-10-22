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
            'message' => "Read the problem statement above.\nSum over cell pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rows and columns separately', 'next' => 's2'],
                ['label' => 'Loop over every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With mn = 10^5 that is about 5 · 10^9 pairs.\nStep back to when you looped over pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Arrangements per pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(mn, k)', 'next' => 'wrong_b'],
                ['label' => 'C(mn − 2, k − 2)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 48 instead of 8.\nStep back to when you used C(mn, k).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). Examples → 8, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
