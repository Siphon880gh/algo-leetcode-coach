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
            'message' => "Read the problem statement above.\nFeasibility test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each drone’s free hours and the shared free hours', 'next' => 's2'],
                ['label' => 'Each drone’s free hours only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 5 instead of 7.\nStep back to when you dropped the shared test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Hours when neither drone can work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiples of r1 · r2', 'next' => 'wrong_b'],
                ['label' => 'Multiples of lcm(r1, r2)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 5 instead of 7.\nStep back to when you used the product.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log(d1 + d2)). Examples → 5, 7, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
