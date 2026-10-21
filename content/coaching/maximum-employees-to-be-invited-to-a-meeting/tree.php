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
            'message' => "Read the problem statement above.\nCan extra people join a cycle of length ≥ 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 's2'],
                ['label' => 'Yes, the chains leading into it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In a big cycle both neighbours of each member are taken; Example 3 → 4, not 5.\nStep back to when you attached chains.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Several mutual pairs with their chains?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take only the best one', 'next' => 'wrong_b'],
                ['label' => 'All of them fit at one table: add them up', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,0,3,2] seats all four people.\nStep back to when you kept one pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(largest cycle, sum over mutual-pair groups)', 'next' => 'success'],
                ['label' => 'Their sum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A big cycle fills the table on its own and cannot share it.\nStep back to when you added them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
