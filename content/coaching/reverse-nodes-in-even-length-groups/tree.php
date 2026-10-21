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
            'message' => "Read the problem statement above.\nParity of which length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The nodes the group actually has', 'next' => 's2'],
                ['label' => 'The planned size g', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In Example 3 the last group is planned as 3 but has 2 nodes, so it is reversed.\nStep back to when you used g.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An odd-length group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse it too', 'next' => 'wrong_b'],
                ['label' => 'Leave it and advance prev by its length', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 keeps 3, 9, 1 in place.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After reversing an even group, the new prev?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The group\'s old first node, now last', 'next' => 'success'],
                ['label' => 'The group\'s old last node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That node is now at the front of the group, so the next group would start in the wrong place.\nStep back to when you set prev.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) extra. Examples → [5,6,2,3,9,1,4,8,3,7], [1,0,1,6], [1,0,1,5,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
