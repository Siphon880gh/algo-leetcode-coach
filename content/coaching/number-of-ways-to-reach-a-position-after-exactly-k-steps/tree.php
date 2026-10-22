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
            'message' => "Read the problem statement above.\nWith d = |endPos − startPos|, how many forward steps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(k + d) / 2', 'next' => 's2'],
                ['label' => 'd', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The other k − d steps are not all backward; startPos = 1, endPos = 3, k = 4 → C(4,2) = 6 instead of C(4,3) = 4.\nStep back to when you chose d forward steps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k − d is odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Round (k + d) / 2 down and continue', 'next' => 'wrong_b'],
                ['label' => 'Return 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → C(10,6) = 210 instead of 0.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Divide factorials how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply by modular inverses', 'next' => 'success'],
                ['label' => 'Integer-divide the factorials after taking them mod 10^9 + 7', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Remainders do not divide; k = 1000, d = 0 → 0 instead of 159835829.\nStep back to when you divided remainders.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
