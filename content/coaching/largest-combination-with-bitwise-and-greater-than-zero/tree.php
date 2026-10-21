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
            'message' => "Read the problem statement above.\nAnswer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Most candidates sharing one bit', 'next' => 's2'],
                ['label' => 'Number of non-zero candidates', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Their AND can be 0; Example 1 → 7 instead of 4.\nStep back to when you counted non-zero values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bits to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … 15', 'next' => 'wrong_b'],
                ['label' => '0 … 23', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Candidates reach 10^7; [2^20, 2^20] → 0 instead of 2.\nStep back to when you stopped at bit 15.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine the bit counts how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the maximum', 'next' => 'success'],
                ['label' => 'Add them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One number is counted once per bit; Example 1 → 19 instead of 4.\nStep back to when you added counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(24 · n). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
