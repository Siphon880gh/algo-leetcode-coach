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
            'message' => "Problem: Given two equal-length lowercase strings, one conversion changes every occurrence of one letter in str1 to another lowercase letter. Return whether str1 can become str2 after zero or more conversions. For instance, \"aabcc\" → \"ccdee\" is possible and \"leetcode\" → \"codeleet\" is not. (Restated from memory; limits and examples may differ slightly.)\nMust the mapping be one-to-one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only a function', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two letters may become the same letter.\nStep back to when you required one-to-one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Mapping is consistent. Always true?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: str2 must use fewer than 26 letters', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Cycles need a spare letter.\nStep back to when you returned true.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "str1 == str2 with all 26 letters. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true', 'next' => 'success'],
                ['label' => 'false', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero conversions are allowed.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"aabcc\" → \"ccdee\": true. \"leetcode\" → \"codeleet\": false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
