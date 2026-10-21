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
            'message' => "Read the problem statement above.\nLoop a and b from 0 to c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: start a = 0 and b = ⌊√c⌋ and squeeze', 'next' => 's2'],
                ['label' => 'Yes: two nested loops', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. c can be 2³¹ − 1, and neither value can exceed √c.\nStep back to when you looped to c.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a² + b² is less than c. Which pointer moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b −= 1', 'next' => 'wrong_b'],
                ['label' => 'a += 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Lowering b makes the sum even smaller.\nStep back to when you moved b.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the loop condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a ≤ b, since a = b is allowed (2 = 1² + 1²)', 'next' => 'success'],
                ['label' => 'a < b', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It misses sums of two equal squares, such as 2 and 8.\nStep back to when you required a < b.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two pointers from 0 and ⌊√c⌋ with 64-bit sums: O(√c) time. 5 → true (1 + 4). 3 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
