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
            'message' => "Read the problem statement above.\nMaximize the sum of the pair minimums. First move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the array', 'next' => 's2'],
                ['label' => 'Pair the largest value with the smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That wastes every large value: [1,2,3,4] gives 1 + 2 = 3 instead of 4.\nStep back to when you paired opposite ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sorted. How do you pair the values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First half with second half: (a0, an), (a1, an+1), …', 'next' => 'wrong_b'],
                ['label' => 'Neighbors: (a0, a1), (a2, a3), …', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each pair loses its larger value, and neighbors lose the least. [1,2,3,4] paired as (1,3), (2,4) gives 3.\nStep back to when you split into halves.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sum of the values at even indexes', 'next' => 'success'],
                ['label' => 'The sum of the values at odd indexes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The odd index holds the larger value of each pair; the minimum sits at the even index.\nStep back to when you summed odd indexes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort and add every other value starting at index 0: O(n log n), or O(n + range) with counting sort. [1,4,3,2] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
