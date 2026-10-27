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
            'message' => "State:\na = [3, 1, 4, 2]\n\nWhat do you have after splitting and sorting the halves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left [1, 3] and right [2, 4], which still need merging', 'next' => 'merge'],
                ['label' => 'Already [1, 2, 3, 4], with no merge step', 'next' => 'w_nomerge'],
            ],
        ],
        'w_nomerge' => [
            'message' => "Wrong.\n\nDivide and conquer sorts the halves, and then the merge produces the full order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'merge' => [
            'message' => "State:\nmerging [1, 3] and [2, 4]\nthe front values are 1 and 2\n\nWhich value goes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, because the smaller front value wins', 'next' => 'space'],
                ['label' => '2, because the right run always wins', 'next' => 'w_right'],
            ],
        ],
        'w_right' => [
            'message' => "Wrong.\n\nThe merge compares the front values and copies the smaller one next.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'merge',
            'choices' => [],
        ],
        'space' => [
            'message' => "State:\nclassic top-down merge sort\n\nHow much extra memory does it use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A Θ(n) temporary buffer', 'next' => 'success'],
                ['label' => 'O(1), like in-place heapsort', 'next' => 'w_o1'],
            ],
        ],
        'w_o1' => [
            'message' => "Wrong.\n\nIn the usual version, merging two runs needs linear extra space.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'space',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Split, sort the halves, then merge by comparing the front values.\n- It takes Θ(n log n) time and Θ(n) space.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
