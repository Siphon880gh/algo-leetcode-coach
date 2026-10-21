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
            'message' => "Read the problem statement above.\nAfter a push, the top equals popped[j]. Pop now or wait?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop now', 'next' => 's2'],
                ['label' => 'Wait', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values are distinct; waiting buries it under later pushes.\nStep back to when you waited.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep popping after one match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, one pop per push', 'next' => 'wrong_b'],
                ['label' => 'Yes, while the top keeps matching', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Several pops can happen between two pushes.\nStep back to when you popped once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When are the sequences valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When every value has been popped (j == n)', 'next' => 'success'],
                ['label' => 'When all values were pushed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pushing always succeeds; the pops decide.\nStep back to when you checked pushes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4,5], [4,5,3,2,1] → true. [1,2,3,4,5], [4,3,5,1,2] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
