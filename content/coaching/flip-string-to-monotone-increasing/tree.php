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
            'message' => "Read the problem statement above.\nYou read a \"1\". What changes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ones += 1; flips stays', 'next' => 's2'],
                ['label' => 'flips += 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A 1 can end a monotone prefix without any flip.\nStep back to when you flipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You read a \"0\". New flips?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'flips + 1', 'next' => 'wrong_b'],
                ['label' => 'min(flips + 1, ones)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Flipping every earlier 1 to 0 may be cheaper.\nStep back to when you always flipped the 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Try all 2ⁿ target strings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the one-pass DP covers every split', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only split points matter, and the DP considers them all.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. \"00110\" → 1. \"010110\" → 2. \"00011000\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
