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
            'message' => "Read the problem statement above.\nn = 10^5. Rerun part I's scan for every split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_a'],
                ['label' => 'No, precompute counts per end with sliding windows', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is O(n²), about 10^10 steps.\nStep back to when you rescanned each split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Substrings ending at j with exactly d distinct letters equal what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The at-most-d count', 'next' => 'wrong_b'],
                ['label' => 'The at-most-d count minus the at-most-(d − 1) count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The at-most count also includes substrings with fewer letters. Using it on the right side gives 3 instead of 2 for \"cab\".\nStep back to when you skipped the subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 26 sliding windows per direction, then products per split. O(26 · n). Examples give 2, 4 and 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
