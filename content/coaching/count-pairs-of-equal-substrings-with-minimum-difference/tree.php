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
            'message' => "Problem: Given two strings, count the index quadruples (i, j, a, b) where the first string's substring i … j equals the second string's substring a … b and j − a is as small as possible among all such equal-substring quadruples. For instance, \"abcd\" and \"bccda\" → 1, \"ab\" and \"ab\" → 2, and \"ab\" and \"cd\" → 0. (Restated from memory; limits and examples may differ slightly.)\nConsider longer substrings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, they only increase j − a', 'next' => 's2'],
                ['label' => 'Yes, all of them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Extending a match moves j right with a fixed.\nStep back to when you enumerated substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Best positions for a letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last in both', 'next' => 'wrong_b'],
                ['label' => 'First in the first string, last in the second', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Minimising j − a wants small j and large a.\nStep back to when you used last in both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Letters only in one string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip them', 'next' => 'success'],
                ['label' => 'Count them with difference 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They form no equal pair at all.\nStep back to when you counted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n). Constructed check → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
