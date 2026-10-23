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
            'message' => "Read the problem statement above.\nNo subarray pays at λ = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the best single subarray', 'next' => 's2'],
                ['label' => 'Return 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 4 → 0 instead of −1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer after the search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f[n]', 'next' => 'wrong_b'],
                ['label' => 'f[n] + λ · m', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [3, −1, 3, −1, 3], m = 1, l = 1, r = 5 → 6 instead of 7.\nStep back to when you forgot to add back the penalty.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log S). Examples → 7, 8, 6, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
