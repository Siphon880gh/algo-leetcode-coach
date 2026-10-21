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
            'message' => "Read the problem statement above.\nComparisons per triple?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All three pairs', 'next' => 's2'],
                ['label' => 'Only adjacent pairs', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 'aba' passes adjacent checks but repeats a.\nStep back to when you skipped s[i] vs s[i + 2].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeated identical substrings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count distinct substrings', 'next' => 'wrong_b'],
                ['label' => 'Count each occurrence', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every occurrence counts.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Last start index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 3', 'next' => 'success'],
                ['label' => 'n − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The window would run past the end.\nStep back to when you went to n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
