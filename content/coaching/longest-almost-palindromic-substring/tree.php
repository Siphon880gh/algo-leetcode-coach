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
            'message' => "Read the problem statement above.\nAnswer from the longest palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Expand with one skip at the first mismatch', 'next' => 's2'],
                ['label' => 'Longest palindrome plus one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 4.\nStep back to when you added one to the palindrome.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which character to skip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the left one', 'next' => 'wrong_b'],
                ['label' => 'Try the left and the right one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): \"aaaba\" → 4 instead of 5.\nStep back to when you tried one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 4, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
