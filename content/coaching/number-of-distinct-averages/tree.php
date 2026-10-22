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
            'message' => "Read the problem statement above.\nPair which values after sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] with nums[n − 1 − i]', 'next' => 's2'],
                ['label' => 'Neighbours nums[2i] and nums[2i + 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each round removes the minimum and the maximum; Example 1 → 3 instead of 2.\nStep back to when you paired neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The averages with integer division', 'next' => 'wrong_b'],
                ['label' => 'The sums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Halves get lost; [0,1,2,2] → 1 instead of 2.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
