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
            'message' => "Read the problem statement above.\nMiddle palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Include it', 'next' => 's2'],
                ['label' => 'Only X and its mirror', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 4 → 4 instead of 5.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Palindrome tables?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Test every substring, O(n³)', 'next' => 'wrong_b'],
                ['label' => 'Expand around centers, O(n²)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With n = 1000 that is about 10⁹ character checks.\nStep back to when you tested every substring.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m + n² + m²). Examples → 2, 1, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
