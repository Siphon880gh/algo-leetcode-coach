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
            'message' => "State:\nnums = [1, 2]\npath = []\ngoal: list all subsets\n\nYou choose to take 1. What is the path now?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1], and then you recurse to decide about 2', 'next' => 'undo'],
                ['label' => '[1, 2] right away, with no recursion', 'next' => 'w_jump'],
            ],
        ],
        'w_jump' => [
            'message' => "Wrong.\n\nEach step decides one number. After taking 1, recurse to decide about 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'undo' => [
            'message' => "State:\npath = [1]\nyou have finished exploring everything under \"take 1\"\n\nWhat must happen before the \"skip 1\" branch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Undo by popping 1, so the path is [] again', 'next' => 'prune'],
                ['label' => 'Leave [1] in place, because later branches ignore it', 'next' => 'w_leave'],
            ],
        ],
        'w_leave' => [
            'message' => "Wrong.\n\nA leftover choice leaks into the next branch. Always undo.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'undo',
            'choices' => [],
        ],
        'prune' => [
            'message' => "State:\nthe partial sum is already 10\nthe target is 7\nall remaining numbers are positive\n\nWhat should you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prune: return without recursing any deeper', 'next' => 'success'],
                ['label' => 'Keep going, because pruning is optional', 'next' => 'w_prune'],
            ],
        ],
        'w_prune' => [
            'message' => "Wrong.\n\nThis path can never come back down to 7, so exploring under it wastes the whole subtree. Cut it early.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'prune',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Choose, explore, then undo.\n- Pop the choice before trying the next one.\n- Prune paths that already break the rules.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
