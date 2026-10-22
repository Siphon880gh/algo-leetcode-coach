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
            'message' => "Problem: You are given a string s. Find the longest substring t of s, other than s itself, such that every letter in t appears in s only inside t. Return its length, or the not-found value the statement gives. Limits are in the official statement. For instance, abba → 2 (bb), and abab has no answer. (Restated from memory; limits and examples may differ slightly.)\nThe whole string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not allowed', 'next' => 's2'],
                ['label' => 'Allowed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Then aaaa → 4 instead of none.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Candidate at j when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always', 'next' => 'wrong_b'],
                ['label' => 'The farthest last occurrence equals j', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abba → 3 (abb, with a outside) instead of 2.\nStep back to when you took every j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 n). abba → 2; abab → none.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
