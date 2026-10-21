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
            'message' => "Read the problem statement above.\nCompare character by character?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare groups of equal letters', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Stretching works on whole groups.\nStep back to when you compared characters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s has a group of 2, the word has 1. Valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: a stretched group must reach at least 3', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"hello\" → \"helo\" fails because ll is only 2.\nStep back to when you accepted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The word's group is longer than s's. Valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: letters can only be added', 'next' => 'success'],
                ['label' => 'Yes if s has 3 or more', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A word cannot shrink to match s.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| + Σ|word|). s \"heeellooo\", [\"hello\",\"hi\",\"helo\"] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
