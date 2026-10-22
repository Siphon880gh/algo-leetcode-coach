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
            'message' => "Read the problem statement above.\npowers is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The set bits of n, smallest first', 'next' => 's2'],
                ['label' => 'Every power of 2 up to n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. They must sum to n; Example 2 → [1] instead of [2].\nStep back to when you listed every power.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compute 2^(exponent sum) how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly in 64-bit', 'next' => 'wrong_b'],
                ['label' => 'Modular power', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The exponent sum reaches 0 + 1 + … + 29 = 435, far past 64 bits.\nStep back to when you computed it exactly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(30 + q log 435). Examples → [2,4,64], [2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
