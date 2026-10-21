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
            'message' => "Read the problem statement above.\nCompare each word with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last kept word', 'next' => 's2'],
                ['label' => 'The first word only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [abba, cd, cd] instead of [abba, cd].\nStep back to when you compared with the first word.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Anagram test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same set of letters', 'next' => 'wrong_b'],
                ['label' => 'Sorted letters equal', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. aab and abb share a set but are not anagrams; [aab, abb] → [aab] instead of both.\nStep back to when you compared sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Keep which of a pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The earlier word', 'next' => 'success'],
                ['label' => 'The later word', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Deleting removes words[i]; Example 1 → [bbaa, cd] instead of [abba, cd].\nStep back to when you kept the later word.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ |w| log |w|). Examples → [abba, cd], [a, b, c, d, e].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
