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
            'message' => "Read the problem statement above.\nTap i covers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[i − r, i + r] clipped to [0, n]', 'next' => 's2'],
                ['label' => '[i, i + r]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Taps water both sides.\nStep back to when you ignored the left side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Coverage ends at i and nothing reaches past?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip ahead', 'next' => 'wrong_b'],
                ['label' => 'Return −1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A gap cannot be watered.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Search all subsets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: greedy reach is optimal', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Extending to the farthest reach never hurts.\nStep back to when you tried subsets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 5, [3,4,1,1,0,0] → 1. n = 3, [0,0,0,0] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
