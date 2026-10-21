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
            'message' => "Read the problem statement above.\nEqual values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not smaller', 'next' => 's2'],
                ['label' => 'Smaller', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only strictly smaller values count.\nStep back to when you counted equals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Use the value range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare all pairs', 'next' => 'wrong_b'],
                ['label' => 'Yes: 0–100 allows counting', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs are O(n²).\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer for x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix count below x', 'next' => 'success'],
                ['label' => 'Prefix count up to x', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That includes x itself.\nStep back to when you included x.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 101). [8,1,2,2,3] → [4,0,1,1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
