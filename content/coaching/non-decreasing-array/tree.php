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
            'message' => "Read the problem statement above.\nIs counting dips (nums[i − 1] > nums[i]) enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one dip can still need two changes', 'next' => 's2'],
                ['label' => 'Yes: at most one dip means true', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [3,4,2,3] has one dip but needs two changes.\nStep back to when you only counted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a dip at i, when do you lower nums[i − 1] to nums[i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always', 'next' => 'wrong_b'],
                ['label' => 'When i < 2 or nums[i − 2] ≤ nums[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. If nums[i − 2] > nums[i], lowering creates a new dip.\nStep back to when you always lowered.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Otherwise?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Raise nums[i] to nums[i − 1] and keep scanning; a second dip means false', 'next' => 'success'],
                ['label' => 'Return false', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Raising may still work: [3,4,2,5] → [3,4,4,5].\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One greedy pass: O(n). [4,2,3] → true. [4,2,1] → false. [3,4,2,3] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
