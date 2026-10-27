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
            'message' => "Read the problem statement above.\nDeleting any a_i leaves a sum divisible by k. What follows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every element has the same remainder as the sum', 'next' => 's2'],
                ['label' => 'Every element is a multiple of k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 has remainders 1, 1, 1, 1 and is valid. Requiring multiples gives 1 instead of 4.\nStep back to when you required multiples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "r and the run length can both reach 10^5. Which type holds (cnt − 1) · r?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 32-bit int', 'next' => 'wrong_b'],
                ['label' => 'A 64-bit integer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The product reaches about 10^10, which overflows 32 bits.\nStep back to when you picked a 32-bit int.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Runs of equal remainder with a 64-bit length test. O(n). Examples give 3, 4 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
