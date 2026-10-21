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
            'message' => "Read the problem statement above.\nBeauty 2 test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greater than the prefix max and smaller than the suffix min', 'next' => 's2'],
                ['label' => 'Greater than the left neighbour and smaller than the right one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is the beauty-1 test; beauty 2 compares with every element on each side.\nStep back to when you used the neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of the checks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Test beauty 1 first and stop if it holds', 'next' => 'wrong_b'],
                ['label' => 'Test beauty 2 first, then beauty 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,2,3] → 2 would score 1.\nStep back to when you tested beauty 1 first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Comparisons?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strict', 'next' => 'success'],
                ['label' => 'Non-strict', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal values do not count; [2,2,2] → 0.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
