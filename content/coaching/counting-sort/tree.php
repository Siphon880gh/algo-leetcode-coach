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
            'message' => "State:\nkeys = [2, 0, 2, 1, 0]\nevery key is between 0 and 2\n\nWhat is the count array after one pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[2, 1, 2], the number of 0s, 1s and 2s', 'next' => 'place'],
                ['label' => '[0, 1, 2], just the distinct keys in order', 'next' => 'w_unique'],
            ],
        ],
        'w_unique' => [
            'message' => "Wrong.\n\nThe count array stores how many times each key appears, duplicates included.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'place' => [
            'message' => "State:\nyou need a stable placement into the output\n\nWhich way do you usually scan the input?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left, using up the running-total positions', 'next' => 'range'],
                ['label' => 'In any order, because stability never matters here', 'next' => 'w_rand'],
            ],
        ],
        'w_rand' => [
            'message' => "Wrong.\n\nStability is the reason you walk the input carefully with the running totals.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'place',
            'choices' => [],
        ],
        'range' => [
            'message' => "State:\nthe keys are arbitrary 64-bit ids, so k is enormous\n\nShould you use counting sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. It needs a small k, or the O(k) memory and time explode.', 'next' => 'success'],
                ['label' => 'Yes. Counting sort always beats comparison sorts.', 'next' => 'w_always'],
            ],
        ],
        'w_always' => [
            'message' => "Wrong.\n\nCounting sort needs a small range of keys. Comparison sorts handle general keys.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'range',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Count the keys, build running totals, then place each key.\n- It runs in O(n + k) when k is small.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
