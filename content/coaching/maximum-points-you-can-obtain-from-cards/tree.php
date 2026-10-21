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
            'message' => "Read the problem statement above.\nGreedy larger end each time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: try every split', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A small end card can hide large ones.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many splits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n', 'next' => 'wrong_b'],
                ['label' => 'k + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only i left and k − i right cards.\nStep back to when you tried n splits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k = n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of all cards', 'next' => 'success'],
                ['label' => 'Special error', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Take everything.\nStep back to when you special-cased it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k). [1,2,3,4,5,6,1], k = 3 → 12. [2,2,2], k = 2 → 4. [9,7,7,9,7,7,9], k = 7 → 55.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
