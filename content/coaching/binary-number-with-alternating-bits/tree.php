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
            'message' => "Read the problem statement above.\nWhat does n ^ (n >> 1) mark?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 1 wherever a bit differs from the next higher bit', 'next' => 's2'],
                ['label' => 'The bits that are set in n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. XOR with the shifted value compares neighbors.\nStep back to when you read it as n's bits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "If the bits alternate, x = n ^ (n >> 1) looks like?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alternating ones and zeros', 'next' => 'wrong_b'],
                ['label' => 'A solid run of ones', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every neighboring pair differs, so every position is 1.\nStep back to when you expected alternation.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you test for a solid run of ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x & (x + 1) == 0', 'next' => 'success'],
                ['label' => 'x % 2 == 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Odd numbers are not all ones; 0b101 is odd.\nStep back to when you checked parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two bit operations: O(1). 5 → true. 7 → false. 10 → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
