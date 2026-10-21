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
            'message' => "Read the problem statement above.\nCompare every pair of words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: adjacent pairs are enough', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorted order is transitive.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which letters decide a pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All positions', 'next' => 'wrong_b'],
                ['label' => 'The first position where they differ', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later letters do not matter once one differs.\nStep back to when you compared all letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "\"apple\" comes before \"app\". Valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a prefix must come first', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The shorter word is smaller when one is a prefix of the other.\nStep back to when you accepted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total letters). [\"hello\",\"leetcode\"], \"hlabcdefgijkmnopqrstuvwxyz\" → true. [\"word\",\"world\",\"row\"], \"worldabcefghijkmnpqstuvxyz\" → false. [\"apple\",\"app\"], \"abcdefghijklmnopqrstuvwxyz\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
