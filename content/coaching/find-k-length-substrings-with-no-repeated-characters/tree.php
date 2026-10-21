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
            'message' => "Problem: Given a string s and an integer k, count the substrings of length k with no repeated character. For instance, \"abcabc\" with k = 3 has four such substrings (abc, bca, cab, abc), and any k above 26 gives 0. (Restated from memory; limits and examples may differ slightly.)\nCheck each length-k substring with a fresh set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: slide one window with counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · k).\nStep back to when you rebuilt sets.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The new letter is already in the window. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the window', 'next' => 'wrong_b'],
                ['label' => 'Shrink from the left until it is not', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Resetting skips valid windows.\nStep back to when you reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k = 30. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => 'Run the window', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only 26 distinct letters exist.\nStep back to when you ran the window.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abcabc\", k = 3 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
