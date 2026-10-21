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
            'message' => "Read the problem statement above.\nAnswer each query by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix XOR in O(1)', 'next' => 's2'],
                ['label' => 'Looping over the range', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n) per query.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range [l, r] equals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p[r] ^ p[l]', 'next' => 'wrong_b'],
                ['label' => 'p[r + 1] ^ p[l]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The range is inclusive of r.\nStep back to when you used p[r].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why does it work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x ^ x = 0 cancels the prefix', 'next' => 'success'],
                ['label' => 'XOR is subtraction', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The shared prefix XORs itself away.\nStep back to when you treated it as subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). [1,3,4,8] → [2,7,14,8]. [4,8,2,10] → [8,0,4,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
