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
            'message' => "Read the problem statement above.\nRecompute each number's chain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: memoize', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Chains share long tails.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie on power?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Larger value first', 'next' => 'wrong_b'],
                ['label' => 'Smaller value first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties sort by value ascending.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1-based', 'next' => 'success'],
                ['label' => '0-based', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. k = 1 means the first element.\nStep back to when you used index k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 12..15, k = 2 → 13. 7..11, k = 4 → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
