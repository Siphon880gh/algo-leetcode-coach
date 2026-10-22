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
            'message' => "Read the problem statement above.\nCost of a substring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best over divisors d of mismatched pairs per class', 'next' => 's2'],
                ['label' => 'Changes to make it a palindrome', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. abab is already semi-palindromic (d = 2); with k = 1 → 2 instead of 0.\nStep back to when you used plain palindromes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Divisors allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd ≤ length', 'next' => 'wrong_b'],
                ['label' => 'd < length', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. d = length makes single-letter classes, so every cost is 0; example 2 → 0 instead of 2.\nStep back to when you allowed d = length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
