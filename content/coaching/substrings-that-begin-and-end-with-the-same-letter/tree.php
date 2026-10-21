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
            'message' => "Problem: Given a string s of lowercase letters, return the number of substrings that begin and end with the same character. Single characters count. For instance, abcba → 7, abacad → 9, and a → 1. (Restated from memory; limits and examples may differ slightly.)\nDo the letters in between matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only the first and last', 'next' => 's2'],
                ['label' => 'The substring must be a palindrome', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In abacad, abaca begins and ends with a and counts, though it is not a palindrome.\nStep back to when you required a palindrome.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Single characters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They do not count', 'next' => 'wrong_b'],
                ['label' => 'They count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abcba → 7 includes its 5 single letters.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Substrings for a letter seen c times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c · (c + 1) / 2', 'next' => 'success'],
                ['label' => 'c²', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. c² counts each pair of positions twice; abcba would give 9 instead of 7.\nStep back to when you used c².",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 7, 9, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
