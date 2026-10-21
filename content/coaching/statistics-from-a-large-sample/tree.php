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
            'message' => "Read the problem statement above.\nExpand the sample into a list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it can hold 10⁹ values', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Work on the counts.\nStep back to when you expanded.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total is even. Median?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The value at total/2', 'next' => 'wrong_b'],
                ['label' => 'Average the values at positions total/2 − 1 and total/2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An even sample has two middle values.\nStep back to when you took one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you find a value at position p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk cumulative counts until they pass p', 'next' => 'success'],
                ['label' => 'Use p as the value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. p is a position, not a value.\nStep back to when you used p directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(256). The statement's two count arrays give [1.0,3.0,2.375,2.5,3.0] and [1.0,4.0,2.18182,2.0,1.0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
