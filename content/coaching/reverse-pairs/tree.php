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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge sort and count cross pairs between sorted halves', 'next' => 's2'],
                ['label' => 'Check every pair i < j', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n² / 2 is about 1.25e9 pairs. Too slow.\nStep back to when you checked every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Both halves are sorted.\nWhen do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'While merging, count when the right value is placed first', 'next' => 'wrong_b'],
                ['label' => 'A separate two-pointer pass before the merge', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Merging changes the order; the condition uses 2 × nums[j], not plain order. Counting during the merge mixes the two tests.\nStep back to when you counted inside the merge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For each j on the right, move i while left[i] <= 2 × right[j]; add mid − i + 1. Then merge. O(n log n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Separate count pass, then merge; 64-bit doubling. Not 315', 'next' => 'success'],
                ['label' => 'Compute 2 × nums[j] in a 32-bit int', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 2 × nums[j] can reach about 4.3e9 and overflow 32-bit ints, which flips comparisons.\nStep back to when you doubled in 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Merge sort with a two-pointer count pass and 64-bit doubles. [2,4,3,5,1] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
