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
            'message' => "Read the problem statement above.\ns[i] ≠ t[j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move on in s, keep j', 'next' => 's2'],
                ['label' => 'Reset j to 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Matched letters stay matched; Example 1 → 6 instead of 4.\nStep back to when you reset.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letters of t missing from s, counted as a multiset', 'next' => 'wrong_b'],
                ['label' => 'len(t) − j', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Order matters; Example 1 → 1 instead of 4.\nStep back to when you counted letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len(s)). Examples → 4, 0, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
