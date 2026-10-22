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
            'message' => "Read the problem statement above.\nLoop the sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From n down to p', 'next' => 's2'],
                ['label' => 'From p up to n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A base gets reused; example 2 → 5 instead of 2.\nStep back to when you looped upward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try bases j while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j < n', 'next' => 'wrong_b'],
                ['label' => 'j^x ≤ n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. For x = 1 that skips n itself; example 2 → 1 instead of 2.\nStep back to when you stopped below n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · n^(1/x)). Examples → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
