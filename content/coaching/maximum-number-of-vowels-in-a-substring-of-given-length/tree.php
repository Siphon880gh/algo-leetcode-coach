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
            'message' => "Read the problem statement above.\nRecount each window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: slide', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(nk).\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leaving index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i − k + 1', 'next' => 'wrong_b'],
                ['label' => 'i − k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That index is still inside the new window.\nStep back to when you used i − k + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Early exit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When count == k', 'next' => 'success'],
                ['label' => 'Never possible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. k vowels is the maximum.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abciiidef\", 3 → 3. \"aeiou\", 2 → 2. \"leetcode\", 3 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
