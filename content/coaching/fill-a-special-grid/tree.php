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
            'message' => "Read the problem statement above.\nQuadrant order (smallest first)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top-right, bottom-right, bottom-left, top-left', 'next' => 's2'],
                ['label' => 'Top-left, then clockwise', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 1 → [[0, 1], [3, 2]], which breaks bottom-left < top-left.\nStep back to when you started top-left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Numbers per quadrant?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2^(n − 1)', 'next' => 'wrong_b'],
                ['label' => '4^(n − 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 2 repeats numbers: only 10 distinct values in 16 cells.\nStep back to when you used 2^(n − 1).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(4^n). Examples → [[0]], [[3, 0], [2, 1]], the 4 × 4 grid.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
