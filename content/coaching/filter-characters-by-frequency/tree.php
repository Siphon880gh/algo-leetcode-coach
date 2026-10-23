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
            'message' => "Problem: Given a lowercase string s and an integer k, keep every character whose total number of occurrences in s is less than k, in the original order, and return the result (empty if none qualify). Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nKeep when count is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '< k', 'next' => 's2'],
                ['label' => '≤ k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. \"aab\", k = 2 → \"aab\" instead of \"b\".\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted by letter', 'next' => 'wrong_b'],
                ['label' => 'The original order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"ba\", k = 2 → \"ab\" instead of \"ba\".\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Checks → \"b\", \"\", \"zzz\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
