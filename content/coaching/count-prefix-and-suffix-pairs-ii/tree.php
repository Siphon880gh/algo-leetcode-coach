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
            'message' => "Read the problem statement above.\nn up to 10^5: test every pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, trie', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 5 · 10^9 pairs.\nStep back to when you tested pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Trie keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Single characters', 'next' => 'wrong_b'],
                ['label' => 'Pairs (s[k], s[len − 1 − k])', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That checks prefixes only; ['a', 'ab'] → 1 instead of 0.\nStep back to when you used characters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → 4, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
