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
            'message' => "Read the problem statement above.\nHow to link indices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union each index with its prime factors', 'next' => 's2'],
                ['label' => 'Compute gcd for every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 10^5 means about 5 · 10^9 pairs, far too slow.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A 1 in an array of length 2 or more?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1 shares no prime with anything; [1, 2, 4] → true instead of false.\nStep back to when you ignored the 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · √max). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
