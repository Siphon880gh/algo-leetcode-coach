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
            'message' => "State:\nnums = [1, 2]\npath = []\ngoal: all subsets\n\nWhat do you do first with element 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take 1, so path = [1], then recurse to decide about 2', 'next' => 'after_take'],
                ['label' => 'Output [1, 2] immediately, with no recursion', 'next' => 'w_jump'],
            ],
        ],
        'w_jump' => [
            'message' => "Wrong.\n\nMake one decision at a time. After taking 1, recurse to decide about 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_take' => [
            'message' => "State:\nyou finished exploring the branch where 1 is taken\npath is still [1]\nnext you will try skipping 1\n\nWhat do you do now?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Undo: pop 1, so path = [] again', 'next' => 'ask_feat'],
                ['label' => 'Leave [1] in place, since the next branch can ignore it', 'next' => 'w_leave'],
            ],
        ],
        'w_leave' => [
            'message' => "Wrong.\n\nA leftover 1 would pollute the branch where 1 is skipped. Restore the path first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_take',
            'choices' => [],
        ],
        'ask_feat' => [
            'message' => "State:\nyou used recursion and pop\n\nIs backtracking a separate language feature?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. It is recursion that restores state.', 'next' => 'success'],
                ['label' => 'Yes. You need a special keyword.', 'next' => 'w_kw'],
            ],
        ],
        'w_kw' => [
            'message' => "Wrong.\n\nNo keyword is needed. Choosing, exploring and undoing is the whole idea.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_feat',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Start with an empty path, take 1, undo it, then skip it.\n- It is ordinary recursion.\n- The undo step is the \"backtrack\".\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
