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
            'message' => "Read the problem statement above.\nWeek i (0-based) total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '28 + 7i', 'next' => 's2'],
                ['label' => '28 every week', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each Monday starts \$1 higher, so each week adds 7 more.\nStep back to when you used 28 every week.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leftover days start at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 dollar', 'next' => 'wrong_b'],
                ['label' => 'w + 1 dollars', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The partial week begins at the next Monday amount.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Simulate instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fine for n ≤ 1000, but the formula is O(1)', 'next' => 'success'],
                ['label' => 'Simulation is required', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Both work; the closed form is simpler.\nStep back to when you insisted on simulation.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 10, 37, 96.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
