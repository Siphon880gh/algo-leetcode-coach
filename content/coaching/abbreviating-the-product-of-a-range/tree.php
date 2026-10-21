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
            'message' => "Read the problem statement above.\nCompute the product directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: remove the zero-making 2s and 5s as you go', 'next' => 's2'],
                ['label' => 'Yes, then strip zeros', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The product of 1 … 10^4 has tens of thousands of digits, far beyond 64 bits.\nStep back to when you multiplied it out.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Abbreviate when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the raw product has more than 10 digits', 'next' => 'wrong_b'],
                ['label' => 'When more than 10 digits remain after removing trailing zeros', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3, 7219856259e3, is shown in full because 10 digits remain.\nStep back to when you counted the zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The last 5 digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Product mod 10^5 with C twos and C fives removed', 'next' => 'success'],
                ['label' => 'Product mod 10^5 of the raw numbers', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The raw suffix ends in the zeros you were supposed to drop.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(right − left). Examples → 24e0, 399168e2, 7219856259e3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
