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
            'message' => "Read the problem statement above.\nFinal root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The unique root value not found among leaves', 'next' => 's2'],
                ['label' => 'The tree with the largest root', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Size says nothing about where a tree attaches.\nStep back to when you picked by value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Validity check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare each node only with its parent', 'next' => 'wrong_b'],
                ['label' => 'DFS with (lo, hi) bounds', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A deep node can break an ancestor's range.\nStep back to when you checked parents only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After the DFS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fail if any tree was not attached', 'next' => 'success'],
                ['label' => 'Return the root', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Unused trees mean the merge is incomplete.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total nodes). Examples → [3,2,5,1,null,4], null, null.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
