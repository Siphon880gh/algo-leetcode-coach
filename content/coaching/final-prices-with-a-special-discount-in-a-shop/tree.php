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
            'message' => "Read the problem statement above.\nDiscount condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Later price ≤ current', 'next' => 's2'],
                ['label' => 'Later price < current', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal prices count.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which later price?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest one', 'next' => 'wrong_b'],
                ['label' => 'The first one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement takes the minimum index j > i.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No discount found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pay full price', 'next' => 'success'],
                ['label' => 'Pay 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [1,2,3,4,5] stays unchanged.\nStep back to when you zeroed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [8,4,6,2,3] → [4,2,4,2,3]. [10,1,1,6] → [9,0,1,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
