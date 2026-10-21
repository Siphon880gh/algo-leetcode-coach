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
            'message' => "Read the problem statement above.\nCombine children with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max', 'next' => 's2'],
                ['label' => 'sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Subordinates are informed in parallel.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A leaf's contribution?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One minute', 'next' => 'wrong_b'],
                ['label' => 'Its informTime, which is 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Leaves inform nobody.\nStep back to when you charged a minute.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Walk up from each employee instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only with memoization', 'next' => 'success'],
                ['label' => 'Yes, plainly', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without memoization a long chain makes it O(n²).\nStep back to when you walked up plainly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 1 → 0. n = 6, head 2 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
