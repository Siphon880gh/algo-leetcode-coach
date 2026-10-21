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
            'message' => "Read the problem statement above.\nEqual values in one row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Must share a rank: union them', 'next' => 's2'],
                ['label' => 'Rank independently', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal cells in a row or column need equal ranks.\nStep back to when you ranked them alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group rank?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 + the cell\'s own row max', 'next' => 'wrong_b'],
                ['label' => '1 + max of row and column maxima over the group', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Linked cells constrain each other.\nStep back to when you used one cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After assigning?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update row and column maxima', 'next' => 'success'],
                ['label' => 'Leave them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Later values must exceed these ranks.\nStep back to when you left them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn log(mn)). Example 1 → [[1,2],[2,3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
