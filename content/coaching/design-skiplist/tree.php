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
            'message' => "Read the problem statement above.\nMove right while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'next.val < target', 'next' => 's2'],
                ['label' => 'next.val ≤ target', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You would pass the node you need to find or erase.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Height of a new node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always the full height', 'next' => 'wrong_b'],
                ['label' => 'Random: add a level with probability 1/2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That turns every level into a full list.\nStep back to when you used full height.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "erase with duplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unlink the one node after update[0] at every level it appears', 'next' => 'success'],
                ['label' => 'Unlink by value at each level', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Different copies could be unlinked on different levels.\nStep back to when you matched by value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) expected. add 1, 2, 3; search(0) → false; add 4; search(1) → true; erase(0) → false; erase(1) → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
