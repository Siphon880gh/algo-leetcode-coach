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
            'message' => "Problem: Each day, every element except the ends rises by 1 if smaller than both neighbours and falls by 1 if larger than both, all at once. Return the array when it stops changing. For instance, [6,2,3,4] becomes [6,3,3,4]. (Restated from memory; limits and examples may differ slightly.)\nUpdate in place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build the next day in a copy', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A changed value would affect its neighbour the same day.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First and last elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare with one neighbour', 'next' => 'wrong_b'],
                ['label' => 'Never change', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only interior elements change.\nStep back to when you changed an end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A day with no change', 'next' => 'success'],
                ['label' => 'After n days', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The number of days depends on the values.\nStep back to when you fixed the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · days). [6,2,3,4] → [6,3,3,4]. [1,6,3,4,3,5] → [1,4,4,4,4,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
