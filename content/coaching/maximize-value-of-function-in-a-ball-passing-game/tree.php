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
            'message' => "Read the problem statement above.\nPass the ball with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary lifting', 'next' => 's2'],
                ['label' => 'Simulating k passes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. k reaches 10^10; that is far too slow.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The score includes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the receivers', 'next' => 'wrong_b'],
                ['label' => 'x plus every receiver', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The starter counts; example 1 → 5 instead of 6.\nStep back to when you left out x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log k), with 64-bit sums. Examples → 6, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
