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
            'message' => "Read the problem statement above.\nFirst final digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ C(n − 2, i) · s[i] mod 10', 'next' => 's2'],
                ['label' => 'Σ s[i] mod 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 and 1, so false instead of true.\nStep back to when you dropped the weights.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "C mod 10?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiplicative update kept mod 10', 'next' => 'wrong_b'],
                ['label' => 'Lucas mod 2 and mod 5, then combine', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 3792339 → false instead of true.\nStep back to when you divided mod 10.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
