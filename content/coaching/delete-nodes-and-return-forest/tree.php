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
            'message' => "Read the problem statement above.\nHow do you check if a value is deleted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A set of to_delete', 'next' => 's2'],
                ['label' => 'Scan the list each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · k).\nStep back to when you scanned the list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does a node join the forest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whenever its parent survives', 'next' => 'wrong_b'],
                ['label' => 'It survives and its parent was deleted (or it is the root)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Then it is still attached.\nStep back to when you added attached nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What does a deleted node return to its parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'null', 'next' => 'success'],
                ['label' => 'Itself', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The parent must drop the link.\nStep back to when you returned the node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4,5,6,7], to_delete [3,5] → [[1,2,null,4],[6],[7]]. [1,2,4,null,3], to_delete [3] → [[1,2,4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
