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
            'message' => "Read the problem statement above.\nSearch forward with BFS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: work backward from target', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Forward values can grow without bound.\nStep back to when you searched forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Backward, target is odd. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Halve it', 'next' => 'wrong_b'],
                ['label' => 'Add 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Odd numbers cannot come from doubling.\nStep back to when you halved.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "target ≤ startValue. Remaining operations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'startValue − target', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You still need that many subtractions forward.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log target). startValue = 2, target = 3 → 2. startValue = 5, target = 8 → 2. startValue = 3, target = 10 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
