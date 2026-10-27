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
            'message' => "State:\nmerge sort has just sorted both halves\n\nWhich phase comes next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Combine, by merging the two sorted halves', 'next' => 'mid'],
                ['label' => 'Divide again, forever', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe combine step merges the halves that were just sorted.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe subproblems keep recomputing the exact same segment\n\nWhich approach fits better?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dynamic programming or memoization, rather than pure divide and conquer', 'next' => 'final'],
                ['label' => 'Just a bigger call stack', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nSubproblems that repeat are the signal for dynamic programming.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nT(n) = 2T(n/2) + O(n)\n\nWhat is the running time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n log n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThere are about log n levels of splitting, and each level does O(n) work in total. That gives O(n log n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Split, solve, combine.\n- The subproblems are independent.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
