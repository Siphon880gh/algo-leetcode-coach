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
            'message' => "Read the problem statement above.\nWhich stored words can match a search word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only words of the same length', 'next' => 's2'],
                ['label' => 'Any word within one edit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only a substitution is allowed, so the lengths must match.\nStep back to when you allowed insertions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The search word is itself in the dictionary. Match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'Not by itself: 0 differences does not count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Exactly one letter must change.\nStep back to when you accepted 0 differences.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you stop comparing two words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As soon as there are two mismatches', 'next' => 'success'],
                ['label' => 'Only after comparing every letter', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two mismatches already rule the word out.\nStep back to when you compared every letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Length buckets plus a mismatch count: O(words · len) per search. Dictionary [\"hello\",\"leetcode\"]: search \"hhllo\" → true; \"hello\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
