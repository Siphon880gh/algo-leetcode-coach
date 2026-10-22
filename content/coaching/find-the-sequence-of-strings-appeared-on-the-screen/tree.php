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
            'message' => "Read the problem statement above.\nRecord when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After every key press', 'next' => 's2'],
                ['label' => 'After each finished character', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [a, ab, abc].\nStep back to when you skipped presses.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last ≠ target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append another a', 'next' => 'wrong_b'],
                ['label' => 'Advance the last character', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last character stays a and never becomes b in example 1.\nStep back to when you appended again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n²) output. Example 1 → [a, aa, ab, aba, abb, abc].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
