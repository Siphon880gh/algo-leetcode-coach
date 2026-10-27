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
            'message' => "State:\nitem with weight 2 and value 5\nat most k = 2 copies\nW = 5\n\nWhat is the best value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10, from two copies', 'next' => 'mid'],
                ['label' => '15, from three copies somehow', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nk caps the item at 2 copies, so the best is 10.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nk is large\n\nHow do you speed things up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split the count into binary packs, then solve as 0-1', 'next' => 'final'],
                ['label' => 'Always expand into k single copies', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nBinary splitting cuts the number of items from k to about log k.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou use the forward loop for unlimited copies, with no check on k\n\nWhat is the risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It can take more than k copies', 'next' => 'success'],
                ['label' => 'It automatically respects k', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe unlimited loop ignores k.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Limit the copies to k.\n- Expand or binary-split the item into 0-1 items.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
