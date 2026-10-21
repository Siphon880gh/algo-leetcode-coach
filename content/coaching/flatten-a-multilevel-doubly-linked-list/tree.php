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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At a node with a child: save next, splice the flattened child in, then reattach next', 'next' => 's2'],
                ['label' => 'Walk the top list, then append every child list at the end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Child lists must be spliced right after their parent. Appending them at the end gives 1..6 then 7.. and breaks the required order.\nStep back to when you appended children at the end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At node 3 with child 7: save t = 4. Flatten the child list (recursively) and get its tail, 10.\nHow do you wire it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only set 3.next = 7 and tail.next = t', 'next' => 'wrong_b'],
                ['label' => '3.next = 7, 7.prev = 3, tail.next = t, t.prev = tail, 3.child = null', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Setting only next pointers leaves prev pointing at the old nodes, so walking backward is broken. It is a doubly linked list.\nStep back to when you skipped the prev links.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Recursion depth can reach n in a deep chain; an explicit stack works too: push next, then child, pop in order. O(n) time. Flatten Binary Tree to Linked List (114) works on a binary tree.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Splice child before saved next, fix both pointers, null the child. Not 114 / 426', 'next' => 'success'],
                ['label' => 'Leave child set; the list order is already right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The judge checks that every child is null after flattening. Leaving it set keeps a second path into the same nodes.\nStep back to when you left child pointers set.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Save next, splice the flattened child, fix next and prev at both seams, clear child. Sample → [1,2,3,7,8,11,12,9,10,4,5,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
