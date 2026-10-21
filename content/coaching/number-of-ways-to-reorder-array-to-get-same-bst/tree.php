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
            'message' => "Read the problem statement above.\nCan the root move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it must stay first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A different first element changes the root.\nStep back to when you moved it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine subtree orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Simple product', 'next' => 'wrong_b'],
                ['label' => 'Binomial interleaving', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Left and right sequences can interleave.\nStep back to when you multiplied only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ways − 1', 'next' => 'success'],
                ['label' => 'ways', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The original order is excluded.\nStep back to when you returned ways.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [2,1,3] → 1. [3,4,5,1,2] → 5. [1,2,3] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
