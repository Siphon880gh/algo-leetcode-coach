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
            'message' => "Problem: You get a lowercase string s. One operation either changes one letter to the next letter ('z' wraps to 'a') or moves the first character to the end. Return the fewest operations that make s a palindrome. It is the large-input version of Minimum Operations to Make a Rotated Palindrome I, so trying every rotation in O(n²) is too slow. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nPair cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(d, 26 − d)', 'next' => 's2'],
                ['label' => '|x − y|', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up value, run in code): \"az\" → 25 instead of 1.\nStep back to when you ignored the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The convolution counts each pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once', 'next' => 'wrong_b'],
                ['label' => 'Twice, so halve it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up value, run in code): \"az\" → 2 instead of 1.\nStep back to when you did not halve.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n log n). Constructed checks → 1, 2, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
