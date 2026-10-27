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
            'message' => "State:\ncombinations of size 2 from [1, 2, 3]\n\nWhich list is correct?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, 2], [1, 3], [2, 3]', 'next' => 'mid'],
                ['label' => 'The same three, plus [2, 1] as a different one', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nCombinations ignore order, so [2, 1] is the same as [1, 2].\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou want to avoid listing the same combination in two orders\n\nWhat is the trick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep a start index and only pick forward', 'next' => 'final'],
                ['label' => 'Use a used[] array exactly as in permutations', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nA forward start index is the usual trick for combinations.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nN-Queens board search\n\nWhat is the choice list at each row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The columns (or cells) that are not attacked', 'next' => 'success'],
                ['label' => 'Take or skip each number from 1 to n, as for subsets', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nBoard search tries placements on the board.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Every family uses the same template with a different choice list.\n- Combinations pick only forward.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
