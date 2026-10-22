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
            'message' => "Read the problem statement above.\nLook partners up among?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earlier points', 'next' => 's2'],
                ['label' => 'All points', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Pairs count twice and points pair with themselves; the examples → 4 and 25.\nStep back to when you used all points.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find partners by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Testing every pair', 'next' => 'wrong_b'],
                ['label' => 'Trying a = 0 … k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n reaches 5 · 10^4, about 1.25 · 10^9 pairs.\nStep back to when you tested pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). Examples → 2, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
