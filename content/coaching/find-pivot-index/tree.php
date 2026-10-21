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
            'message' => "Read the problem statement above.\nRecompute both sides for each index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: right = total − left − nums[i]', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you recomputed sums.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do you add nums[i] to left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before the check', 'next' => 'wrong_b'],
                ['label' => 'After the check', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pivot itself belongs to neither side.\nStep back to when you added first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several pivots exist. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost', 'next' => 'success'],
                ['label' => 'The last', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for the leftmost pivot index.\nStep back to when you kept scanning.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time, O(1) space. [1,7,3,6,5,6] → 3. [1,2,3] → -1. [2,1,-1] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
