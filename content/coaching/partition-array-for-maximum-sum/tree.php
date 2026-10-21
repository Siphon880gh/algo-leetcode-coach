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
            'message' => "Read the problem statement above.\ndp[i] means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best sum of the first i elements', 'next' => 's2'],
                ['label' => 'Best sum of the block ending at i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The state must cover the whole prefix.\nStep back to when you scored one block.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Block of length len ending at i. Its value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of the block', 'next' => 'wrong_b'],
                ['label' => 'max of the block · len', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every element becomes the block maximum.\nStep back to when you summed the block.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you get the block maximum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it as the block grows leftward', 'next' => 'success'],
                ['label' => 'Recompute it for each len', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That adds another factor of k.\nStep back to when you recomputed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). [1,15,7,9,2,5,10], k = 3 → 84. [1,4,1,5,7,3,6,1,9,9,3], k = 4 → 83. [1], k = 1 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
