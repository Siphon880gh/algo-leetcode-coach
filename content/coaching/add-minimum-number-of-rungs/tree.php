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
            'message' => "Read the problem statement above.\nStart height?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0, the floor', 'next' => 's2'],
                ['label' => 'The first rung', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The floor-to-first-rung gap may need rungs.\nStep back to when you started at the first rung.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rungs for a gap g?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'g // dist', 'next' => 'wrong_b'],
                ['label' => '(g − 1) // dist', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A gap of exactly dist needs none.\nStep back to when you used g // dist.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Simulate one rung at a time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use the formula', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Gaps reach 10^9.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
