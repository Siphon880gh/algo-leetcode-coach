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
            'message' => "Read the problem statement above.\nWhich palindromes can 16 reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any palindrome, like 11', 'next' => 'wrong_a'],
                ['label' => 'Only even ones, like 8 and 22', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Steps of 2 never change parity, so 11 is out of reach. Ignoring parity gives 7 instead of 9 for Example 1.\nStep back to when you ignored parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you find the nearest even palindrome quickly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Round to the nearest multiple of 11', 'next' => 'wrong_b'],
                ['label' => 'Binary-search a sorted list of even palindromes', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Palindromes are not all multiples of 11: 131 is not, and 11 itself is odd.\nStep back to when you used multiples of 11.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Precompute palindromes by parity, then binary search. O(n log P). Examples give 9, 2 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
