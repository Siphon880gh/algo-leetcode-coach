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
                ['label' => 'Every element is a multiple of k', 'next' => 'wrong_a'],
                ['label' => 'Every element has the same remainder as the sum', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 has remainders 1, 1, 1, 1 and is valid. Requiring multiples gives 1 instead of 4.\nStep back to when you required multiples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 3: [5, 5], k = 4\nremainder 1, length 2\nValid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, the remainders match', 'next' => 'wrong_b'],
                ['label' => 'No, (2 − 1) · 1 is not divisible by 4', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deleting one 5 leaves 5, which 4 does not divide. The length rule (L − 1) · r ≡ 0 fails.\nStep back to when you skipped the length rule.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Runs of equal remainder with (L − 1) · r ≡ 0 (mod k). O(n). Examples give 3, 4 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
