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
            'message' => "Problem: Given a string, return the number of substrings that contain only one distinct letter. For instance, \"aaaba\" has 8 and \"aaaaaaaaaa\" has 55. (Restated from memory; limits and examples may differ slightly.)\nList all substrings and check them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use runs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) substrings.\nStep back to when you listed them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A run of length L contributes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L', 'next' => 'wrong_b'],
                ['label' => 'L(L + 1) / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each run holds many substrings.\nStep back to when you added L.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two separate runs of a. Combine them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count each run alone', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A substring across them contains another letter.\nStep back to when you merged runs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"aaaba\" → 8. \"aaaaaaaaaa\" → 55.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
