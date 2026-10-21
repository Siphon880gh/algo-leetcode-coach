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
            'message' => "Read the problem statement above.\nRobot 1 aims to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minimise what robot 2 can collect', 'next' => 's2'],
                ['label' => 'Maximise its own points', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In [[1,1,2],[2,1,1]], maximising its own 5 points leaves 3, but taking 4 leaves only 2.\nStep back to when you maximised robot 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Robot 2's best after robot 1 turns at column i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'top after i + bottom before i', 'next' => 'wrong_b'],
                ['label' => 'max(top after i, bottom before i)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Robot 2 also turns down once, so it gets only one of the two leftovers.\nStep back to when you added them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sum type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 5 · 10^4 cells of up to 10^5 reach 5 · 10^9.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 4, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
