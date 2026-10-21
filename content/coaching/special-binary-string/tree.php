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
            'message' => "Read the problem statement above.\nWhat can a move swap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two adjacent special substrings, which act like balanced parenthesis blocks', 'next' => 's2'],
                ['label' => 'Any two characters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only whole special substrings move.\nStep back to when you swapped characters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you find the top-level blocks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split at every 0', 'next' => 'wrong_b'],
                ['label' => 'Scan with a balance counter and cut each time it returns to 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A block ends only where the balance returns to 0.\nStep back to when you split at each 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "With each block improved recursively, how do you combine them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort descending and concatenate', 'next' => 'success'],
                ['label' => 'Keep the original order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adjacent swaps can produce any order, and descending order is the largest.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Recursive sort: O(n²). \"11011000\" → \"11100100\". \"10\" → \"10\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
