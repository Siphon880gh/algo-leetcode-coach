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
            'message' => "Read the problem statement above.\n\"kkk\", split after index 0. Can \"k\" pair with \"kk\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, the lengths differ', 'next' => 'wrong_a'],
                ['label' => 'Yes, both have 1 distinct letter', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only distinct counts must match. Requiring equal lengths gives 2 instead of 4.\nStep back to when you compared lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For a fixed split, how do you count the pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bucket left substrings by distinct count, then add the bucket for each right substring', 'next' => 'success'],
                ['label' => 'Try every (i, k) pair and recount letters', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is at least O(n³) overall, about 8 × 10^9 steps for n = 2000.\nStep back to when you tried every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Buckets per split. O(n²). Examples give 2, 4 and 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
