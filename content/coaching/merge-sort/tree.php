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
            'message' => "State:\na = [3, 1, 4, 2]\n\nAfter split + sorting halves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left [1, 3], right [2, 4] — then merge', 'next' => 'merge'],
                ['label' => 'Already [1, 2, 3, 4] with no merge step', 'next' => 'w_nomerge'],
            ],
        ],
        'w_nomerge' => [
            'message' => "Wrong.\n\nDivide-and-conquer sorts halves, then merge invents the full order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'merge' => [
            'message' => "State:\nmerging [1, 3] and [2, 4]\nheads = 1 and 2\n\nWho goes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 — smaller head wins', 'next' => 'space'],
                ['label' => '2 — right run always wins ties/heads', 'next' => 'w_right'],
            ],
        ],
        'w_right' => [
            'message' => "Wrong.\n\nMerge compares heads; the smaller one is copied next.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'merge',
            'choices' => [],
        ],
        'space' => [
            'message' => "State:\nclassic top-down merge sort\n\nExtra memory?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Θ(n) temporary buffer', 'next' => 'success'],
                ['label' => 'O(1) like in-place heapsort', 'next' => 'w_o1'],
            ],
        ],
        'w_o1' => [
            'message' => "Wrong.\n\nMerging two runs needs linear auxiliary space in the usual version.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'space',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Split, sort halves, merge by heads\n- Θ(n log n) time, Θ(n) space\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
