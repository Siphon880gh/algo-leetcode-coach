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
            'message' => "Read the problem statement above.\nWhich is the prefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The word is a prefix of s', 'next' => 's2'],
                ['label' => 's is a prefix of the word', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of 3.\nStep back to when you reversed the test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeated words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count distinct words', 'next' => 'wrong_b'],
                ['label' => 'Count each copy', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 1 instead of 2.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Match where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the start of s', 'next' => 'success'],
                ['label' => 'Anywhere in s', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. b and bc are inside abc but not prefixes; Example 1 → 6 instead of 3.\nStep back to when you allowed any position.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ |w|). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
