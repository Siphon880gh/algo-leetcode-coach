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
            'message' => "Read the problem statement above.\nRepresent a word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 26-bit letter mask', 'next' => 's2'],
                ['label' => 'The sorted string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Strings make each add, delete or replace check costly; letters never repeat, so a mask holds everything.\nStep back to when you kept strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find replace neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare every pair of words', 'next' => 'wrong_b'],
                ['label' => 'Union through each mask with one letter deleted', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Up to 2 · 10^4 words give about 2 · 10^8 pairs.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two equal words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Connected: replacing a letter with itself is allowed', 'next' => 'success'],
                ['label' => 'Not connected', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement allows replacing a letter with itself.\nStep back to when you kept them apart.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n · α(n)). Examples → [2,3], [1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
