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
            'message' => "Read the problem statement above.\nSearch how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greedy digits with a feasibility DP', 'next' => 's2'],
                ['label' => 'Step down from 99…9', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. For k = 5 every palindrome starting with 9, 8, 7 or 6 comes first.\nStep back to when you stepped down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair i contributes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd · 10^i', 'next' => 'wrong_b'],
                ['label' => 'd · (10^i + 10^(n − 1 − i))', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 89798 instead of 89898.\nStep back to when you counted one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k · 10). Examples → 595, 8, 89898.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
