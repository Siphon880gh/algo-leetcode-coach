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
            'message' => "Read the problem statement above.\nTriangles at a corner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(row ones − 1)(column ones − 1)', 'next' => 's2'],
                ['label' => 'row ones × column ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The corner counts itself: example 1 → 14 instead of 2.\nStep back to when you dropped the − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Corners at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every cell', 'next' => 'wrong_b'],
                ['label' => 'Cells with 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 2.\nStep back to when you used every cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n); use 64-bit. Examples → 2, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
