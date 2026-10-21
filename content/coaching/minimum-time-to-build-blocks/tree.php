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
            'message' => "Problem: Each block takes a given time to build, one worker builds one block, and a worker can split into two at a fixed split cost. Starting with one worker, return the minimum time to build all blocks. For instance, [1,2] with split 5 takes 7, and [1,2,3] with split 1 takes 4. (Restated from memory; limits and examples may differ slightly.)\nMerged cost of a and b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'split + max(a, b)', 'next' => 's2'],
                ['label' => 'split + a + b', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The two workers run in parallel.\nStep back to when you added both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merge which two?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two largest', 'next' => 'wrong_b'],
                ['label' => 'The two smallest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The longest jobs should be split off earliest.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One block left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its time is the answer', 'next' => 'success'],
                ['label' => 'Add one more split', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One worker can build it directly.\nStep back to when you added a split.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1] with split 1 → 1. [1,2] with split 5 → 7. [1,2,3] with split 1 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
