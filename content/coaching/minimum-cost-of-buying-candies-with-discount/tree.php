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
            'message' => "Read the problem statement above.\nSort order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Descending', 'next' => 's2'],
                ['label' => 'Ascending, then skip every third', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ascending [1,2,3] would take 3 free, but the free candy may cost at most the cheaper one bought.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which one is free?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The most expensive in each group', 'next' => 'wrong_b'],
                ['label' => 'The third in each group of three', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The free candy cannot cost more than either bought candy; Example 1 → 5, not 3.\nStep back to when you freed the priciest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "1 or 2 candies left at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pay for them', 'next' => 'success'],
                ['label' => 'Take one free', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A free candy needs two bought ones first; Example 3 [5,5] → 10.\nStep back to when you freed a leftover.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 5, 23, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
