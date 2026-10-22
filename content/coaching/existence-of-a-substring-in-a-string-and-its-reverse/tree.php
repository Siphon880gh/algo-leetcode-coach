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
            'message' => "Read the problem statement above.\nCompare pairs of s with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pairs of reverse(s)', 'next' => 's2'],
                ['label' => 'Pairs of s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every pair is in s itself: example 3 → true instead of false.\nStep back to when you used s.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whether s is a palindrome', 'next' => 'wrong_b'],
                ['label' => 'Length-2 substrings', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. leetcode is not a palindrome, yet ee works: example 1 → false instead of true.\nStep back to when you checked the whole string.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
