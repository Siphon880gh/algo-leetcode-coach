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
            'message' => "Read the problem statement above.\nCompare each node with all its ancestors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: carry the path\'s min and max', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · h).\nStep back to when you compared with all ancestors.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a node, update what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only hi', 'next' => 'wrong_b'],
                ['label' => 'lo = min(lo, val), hi = max(hi, val)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A small ancestor can give the largest difference too.\nStep back to when you kept only hi.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "At a null child, return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi − lo', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The path's difference would be lost.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [8,3,10,1,6,null,14,null,null,4,7,13] → 7. [1,null,2,null,0,3] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
