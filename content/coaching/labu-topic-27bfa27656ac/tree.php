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
            'message' => "State:\ncheck palindrome on abba\n\nTool?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two pointers from ends', 'next' => 'mid'],
                ['label' => 'Sort the string first', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nEnds-inward compares chars.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nn immutable += chunks\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) copying', 'next' => 'final'],
                ['label' => 'Always O(n)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nImmutables may copy each time.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nlongest substring with ≤2 distinct chars\n\nPattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sliding window + counts', 'next' => 'success'],
                ['label' => 'Edit distance DP only', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nWindow + freq map fits.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Pointers/windows/builders\n- Watch concat costs\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
