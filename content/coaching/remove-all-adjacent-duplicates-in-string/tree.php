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
            'message' => "Read the problem statement above.\nScan and delete pairs until none remain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one pass with a stack', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Repeated scans are O(n²).\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Current character equals the top. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push it', 'next' => 'wrong_b'],
                ['label' => 'Pop the top and drop the character', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The two cancel.\nStep back to when you pushed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Does the removal order change the result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the final string is unique', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every order ends with the same string.\nStep back to when you said yes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abbaca\" → \"ca\". \"azxxzy\" → \"ay\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
