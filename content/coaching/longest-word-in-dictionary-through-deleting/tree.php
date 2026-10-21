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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two-pointer subsequence check for each word', 'next' => 's2'],
                ['label' => 'Compare letter counts of word and s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Letter counts ignore order. \"pa\" is not formable from \"ap\".\nStep back to when you compared letter counts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two words pass.\nWhich is better?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lexicographically smaller always wins', 'next' => 'wrong_b'],
                ['label' => 'Longer wins; equal length → lexicographically smaller', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Length comes first. [\"a\", \"apple\"] → \"apple\".\nStep back to when you compared alphabetically first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Or sort by (−len, word) and return the first passing word. O(D × (|s| + L)).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In-order pointer check, (length, lexicographic) ranking', 'next' => 'success'],
                ['label' => 'Let the pointer in s restart for each letter', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Checking with s's letters in any order breaks the subsequence rule.\nStep back to when you let pointers move backward.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Subsequence check plus a length-then-alphabet compare. → \"apple\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
