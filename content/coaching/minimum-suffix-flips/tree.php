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
            'message' => "Read the problem statement above.\nInitial state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All zeros', 'next' => 's2'],
                ['label' => 'The first target bit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. s starts as all zeros.\nStep back to when you started from target.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On a mismatch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip only this bit', 'next' => 'wrong_b'],
                ['label' => 'Flip the suffix: toggle the state', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each operation flips a whole suffix.\nStep back to when you flipped one bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Simulate flips?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count changes', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(n²).\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"10111\" → 3. \"101\" → 3. \"00000\" → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
