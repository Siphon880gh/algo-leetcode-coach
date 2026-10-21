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
            'message' => "Read the problem statement above.\nWhere is the minimum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the root: each parent equals its smaller child', 'next' => 's2'],
                ['label' => 'You must scan the whole tree to find it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The special property puts the minimum at the root.\nStep back to when you scanned for the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A node is larger than the root. Do you go below it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: keep descending', 'next' => 'wrong_b'],
                ['label' => 'No: record it as a candidate and stop there', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values never decrease going down, so nothing below can beat it.\nStep back to when you kept descending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No candidate was found. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '-1', 'next' => 'success'],
                ['label' => 'The root value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The root is the minimum, not a second minimum.\nStep back to when you returned the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Pruned DFS: O(n). [2,2,5,null,null,5,7] → 5. [2,2,2] → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
