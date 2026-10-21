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
            'message' => "Read the problem statement above.\nBest spot for one mailbox?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Median of the group', 'next' => 's2'],
                ['label' => 'Mean of the group', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The median minimises total absolute distance.\nStep back to when you used the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Groups contiguous?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any partition', 'next' => 'wrong_b'],
                ['label' => 'Yes, in sorted order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Interleaved groups are never better.\nStep back to when you allowed any partition.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Unsorted input?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort first', 'next' => 'success'],
                ['label' => 'Use as given', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Contiguity needs sorted order.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · k). [1,4,8,10,20], 3 → 5. [2,3,5,12,18], 2 → 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
