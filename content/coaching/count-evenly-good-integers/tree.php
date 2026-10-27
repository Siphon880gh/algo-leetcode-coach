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
            'message' => "Problem: You get two integers l and r with 1 ≤ l ≤ r ≤ 10^15. An integer is evenly good when it has an even number of even digits (0, 2, 4, 6, 8); having none counts as even. Return how many evenly good integers lie in [l, r]. Example: l = 18, r = 22 gives 3, namely 19, 20 and 22.\nr can be 10^15. How do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check every number in [l, r]', 'next' => 'wrong_a'],
                ['label' => 'Count up to a bound with a digit DP and use F(r) − F(l − 1)', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is up to 10^15 numbers.\nStep back to when you listed them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inside the DP, 7 is written as 07. Is that leading 0 an even digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, 0 is even', 'next' => 'wrong_b'],
                ['label' => 'No, a digit counts only after the number starts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 7 has no even digits, so it is good. Counting padded zeros gives 4 instead of 5 for [1, 10].\nStep back to when you counted the leading zero.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Digit DP on (position, parity, tight, started). Examples give 3, 2 and 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
