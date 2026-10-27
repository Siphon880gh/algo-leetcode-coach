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
            'message' => "State:\nhouses = [2, 7, 9, 3, 1]\nyou cannot rob neighbors\nno houses considered yet\n\nAfter house 0 (value 2), what is best[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'after0'],
                ['label' => '0, leaving it alone', 'next' => 'w0'],
            ],
        ],
        'w0' => [
            'message' => "Wrong.\n\nRobbing the only house so far is allowed, so best[0] = 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after0' => [
            'message' => "State:\nbest[0] = 2\nhouse 1 has value 7\n\nWhat is best[1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '7, by taking 7, which beats 2', 'next' => 'ask_final'],
                ['label' => '9, by taking both 2 and 7', 'next' => 'w_adj'],
            ],
        ],
        'w_adj' => [
            'message' => "Wrong.\n\nNeighbors are forbidden. The better of skipping (2) and taking (7) is 7.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after0',
            'choices' => [],
        ],
        'ask_final' => [
            'message' => "State:\nyou keep choosing between take and skip until the end\n\nWhat is the final best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '12, from houses 2, 9 and 1', 'next' => 'ask_pat'],
                ['label' => '22, the sum of all houses', 'next' => 'w_all'],
            ],
        ],
        'w_all' => [
            'message' => "Wrong.\n\nThe neighbor rule stops you from taking everything. 2 + 9 + 1 = 12.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_final',
            'choices' => [],
        ],
        'ask_pat' => [
            'message' => "State:\nyou can say \"the best total using houses 0 to i\"\n\nWhich pattern family is this?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Linear 1D take-or-skip, not knapsack', 'next' => 'success'],
                ['label' => 'The complete knapsack capacity loop', 'next' => 'w_pat'],
            ],
        ],
        'w_pat' => [
            'message' => "Wrong.\n\nThere is no bag capacity here. A state along one line of indices means linear DP.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_pat',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Build the tiny example first.\n- Name the state.\n- Then choose the linear take-or-skip pattern.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
