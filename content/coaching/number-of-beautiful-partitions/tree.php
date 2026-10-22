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
            'message' => "Read the problem statement above.\nBefore the DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0 unless s[0] is prime and s[n − 1] is not', 'next' => 's2'],
                ['label' => 'Go straight to the DP', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The whole string is the first and last part; s = 13, k = 1, minLength = 1 → 1 instead of 0.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A cut before index i is allowed when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's[i] is prime', 'next' => 'wrong_b'],
                ['label' => 's[i] is prime and s[i − 1] is not', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The part on the left must end in a non-prime; Example 1 → 6 instead of 3.\nStep back to when you ignored s[i − 1].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · n). Examples → 3, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
