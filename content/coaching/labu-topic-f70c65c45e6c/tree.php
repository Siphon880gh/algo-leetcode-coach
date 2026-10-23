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
            'message' => "State:\nsubsets of [1,1,2], need unique sets\n\nPrep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort so equal 1s are adjacent', 'next' => 'mid'],
                ['label' => 'Never sort', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nSorting enables the neighbor skip rule.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nat a depth, nums[i]==nums[i-1], and i-1 not used here\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip i', 'next' => 'final'],
                ['label' => 'Must take i anyway', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThat skip removes duplicate branches.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nwithout dedup\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Duplicate answers in the result list', 'next' => 'success'],
                ['label' => 'Faster correct answers', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nDup branches emit dup subsets.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Sort + skip equal unused neighbors\n- Unique results\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
