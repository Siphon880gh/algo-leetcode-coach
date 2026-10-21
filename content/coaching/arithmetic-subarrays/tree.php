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
            'message' => "Read the problem statement above.\nCheck the slice as given?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it may be rearranged, so sort', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rearrangement is allowed.\nStep back to when you checked the raw order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Condition after sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Differences increasing', 'next' => 'wrong_b'],
                ['label' => 'Every difference equals the first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Arithmetic means a constant step.\nStep back to when you allowed change.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Faster check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min, max, step, and a seen set in O(len)', 'next' => 'success'],
                ['label' => 'None exists', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The step is fixed by (max − min) / (len − 1).\nStep back to when you said none.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n log n). Example 1 → [true,false,true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
