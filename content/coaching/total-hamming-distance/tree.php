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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count per bit position instead of per pair', 'next' => 's2'],
                ['label' => 'Run Hamming Distance (461) on every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairs are about 5e7, times 32 bits: over 1e9 checks. Too slow.\nStep back to when you looped over pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At bit i, a values have a 1.\nHow many pairs differ at bit i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a × a', 'next' => 'wrong_b'],
                ['label' => 'a × (n − a)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs of two ones or two zeros agree at that bit. Only a one paired with a zero differs.\nStep back to when you counted a × a or a × n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sum a × (n − a) over the bit positions. O(32 n) time, O(1) space. The total fits in 32 bits here, but 64-bit is a safe habit.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ a × (n − a) over bits. Not 461 per pair', 'next' => 'success'],
                ['label' => 'Divide the total by 2 for double counting', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each pair differs at a bit or not; it is counted once per bit it differs in. Dividing by 2 halves the true answer.\nStep back to when you divided by 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Per bit, ones times zeros, summed. [4,14,2] → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
