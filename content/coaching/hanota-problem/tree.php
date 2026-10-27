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
            'message' => "State:\nn = 2\nA = [large, small]\nB = []\nC = []\ngoal: both disks on C\n\nWhat is the first legal move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move the small disk from A to B', 'next' => 'after1'],
                ['label' => 'Move the large disk from A to C first', 'next' => 'w_large'],
            ],
        ],
        'w_large' => [
            'message' => "Wrong.\n\nThe small disk is still on top of the large one. Move the small disk out of the way first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after1' => [
            'message' => "State:\nA = [large]\nB = [small]\nC = []\n\nWhat comes next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move the large disk from A to C, then the small disk from B to C', 'next' => 'ask_n3'],
                ['label' => 'Move the small disk from B to C now, while the large disk is still on A', 'next' => 'w_order'],
            ],
        ],
        'w_order' => [
            'message' => "Wrong.\n\nThen the small disk would sit alone on C, and the large disk could not go on top of it. Move the large disk to C while the small one waits on B.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after1',
            'choices' => [],
        ],
        'ask_n3' => [
            'message' => "State:\nn = 2 took 3 moves\nuse the same pattern for n = 3\n\nHow many moves in total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '7, which is 2³ − 1', 'next' => 'success'],
                ['label' => '3, one move per disk', 'next' => 'w_count'],
            ],
        ],
        'w_count' => [
            'message' => "Wrong.\n\nMove the two smaller disks aside (3 moves), move the largest (1 move), then move the two disks on top (3 moves). That is 7.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_n3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- With n = 2, move the small disk aside, move the large disk, then put the small disk on top.\n- With n = 3, the same idea takes 7 moves.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
