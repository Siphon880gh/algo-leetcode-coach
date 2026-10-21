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
            'message' => "Read the problem statement above.\nWhat is the map key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The file content', 'next' => 's2'],
                ['label' => 'The file name', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Duplicates are files with the same content; names can repeat across folders without matching.\nStep back to when you keyed by name.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you store for each file?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just the file name', 'next' => 'wrong_b'],
                ['label' => 'directory + "/" + name', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same name can sit in several folders, and the output needs full paths.\nStep back to when you stored the bare name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which groups do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Groups with at least two paths', 'next' => 'success'],
                ['label' => 'Every group', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A content seen once is not a duplicate.\nStep back to when you returned every group.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Content → full paths, keep groups of two or more: O(total input length).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
