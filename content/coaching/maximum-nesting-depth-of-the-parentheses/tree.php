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
            'message' => "Read the problem statement above.\nNeed a stack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a counter suffices', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only the depth matters.\nStep back to when you used a stack.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to update the max?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right after )', 'next' => 'wrong_b'],
                ['label' => 'Right after (', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After ) the depth has dropped.\nStep back to when you updated on ).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Validity check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed: input is a VPS', 'next' => 'success'],
                ['label' => 'Required', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement guarantees a valid string.\nStep back to when you validated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
