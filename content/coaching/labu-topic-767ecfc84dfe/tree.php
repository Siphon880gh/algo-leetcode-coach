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
            'message' => "State:\nlist the permutations of [1, 2] with backtracking\n\nHow many leaves does the decision tree have?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2, one for each complete order (2! = 2)', 'next' => 'mid'],
                ['label' => 'Only 1', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBoth orders, [1, 2] and [2, 1], appear as leaves.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe partial path already breaks a hard constraint\n\nWhat do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prune it and return', 'next' => 'final'],
                ['label' => 'Keep exploring in case it fixes itself', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nA partial path that is already invalid can never become valid. Prune it.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou have finished trying one choice\n\nWhat must happen before the next choice at this depth?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Undo the marks you made', 'next' => 'success'],
                ['label' => 'Leave the marks in place for the next choice', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nUndoing is required, or the next choice sees the wrong state.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Walk the decision tree.\n- Prune dead ends.\n- Undo after each choice.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
