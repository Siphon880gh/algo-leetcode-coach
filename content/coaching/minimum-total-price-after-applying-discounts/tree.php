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
            'message' => "Read the problem statement above.\nLargest discount goes to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest price', 'next' => 's2'],
                ['label' => 'The smallest price', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 33.4 instead of 32.5.\nStep back to when you paired it with the smallest price.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "More discounts than items?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use them in input order', 'next' => 'wrong_b'],
                ['label' => 'Use the largest ones', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 132 instead of 92.\nStep back to when you took them in input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m log m). Examples → 32.5, 92, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
