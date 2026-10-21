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
            'message' => "Read the problem statement above.\nIndex base?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0-based', 'next' => 's2'],
                ['label' => '1-based', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answers are 0-based positions.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After recording?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap it with the front', 'next' => 'wrong_b'],
                ['label' => 'Move the value to the front', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Everything before it shifts right.\nStep back to when you swapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Faster structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fenwick tree over positions', 'next' => 'success'],
                ['label' => 'Sorting each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting does not track positions.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [3,1,2,1], m = 5 → [2,1,2,1]. [4,1,2,2], m = 4 → [3,1,2,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
