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
            'message' => "Read the problem statement above.\nWhat do you track?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The remainder of 1, 11, 111, … mod k', 'next' => 's2'],
                ['label' => 'Nothing: answer k − 1 when gcd(k, 10) = 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you used a formula.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When is it −1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when k is even', 'next' => 'wrong_b'],
                ['label' => 'No zero remainder within k steps', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): k = 5 is odd, yet no all-ones number is divisible by it, so the answer is −1.\nStep back to when you tested parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k). Examples → 3, 6, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
