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
            'message' => "Problem: Given a string s of lowercase letters and an integer count, a substring is an equal count substring if every distinct letter in it appears exactly count times. Return the number of equal count substrings. For instance, \"aaabcbbcc\" with count 3 → 3, \"abcd\" with count 2 → 0, and \"a\" with count 5 → 0. (Restated from memory; limits and examples may differ slightly.)\nWhich window lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'u · count for u = 1 … 26', 'next' => 's2'],
                ['label' => 'Every length 1 … n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only multiples u · count can be valid, and trying every length is O(n²).\nStep back to when you tried every length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letters absent from the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They must also appear count times', 'next' => 'wrong_b'],
                ['label' => 'Ignore them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only letters that appear need count occurrences; aaabcbbcc with count 3 → 3.\nStep back to when you required every letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Overlapping valid windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each start separately', 'next' => 'success'],
                ['label' => 'Skip past a valid window', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. aaaa with count 2 has 3 valid substrings (aa at 0, 1, 2), not 2.\nStep back to when you skipped ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n). Constructed checks → 3, 0, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
