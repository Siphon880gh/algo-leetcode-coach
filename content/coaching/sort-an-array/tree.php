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
            'message' => "Read the problem statement above.\nQuicksort with the first element as pivot?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sorted or equal inputs make it O(n²)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Adversarial tests include sorted and all-equal arrays.\nStep back to when you fixed the pivot.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you merge two sorted halves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Concatenate and sort again', 'next' => 'wrong_b'],
                ['label' => 'Two pointers, taking the smaller head each time', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That defeats the purpose.\nStep back to when you re-sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Allocate a new buffer in every call?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: reuse one buffer of size n', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It works but wastes time and memory.\nStep back to when you allocated per call.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [5,2,3,1] → [1,2,3,5]. [5,1,1,2,0,0] → [0,0,1,1,2,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
