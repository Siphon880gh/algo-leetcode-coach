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
            'message' => "State:\ncapacity = 4\ntable = [ _, _, _, _ ]\nA hashes to bucket 2\nstrategy: chaining\n\nWhat does the table look like after inserting A?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[ _, _, A, _ ], with A in bucket 2', 'next' => 'after_a'],
                ['label' => 'A is rejected, because an empty table cannot store keys', 'next' => 'w_empty'],
            ],
        ],
        'w_empty' => [
            'message' => "Wrong.\n\nEmpty slots are ready for the first key. Put A in bucket 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_a' => [
            'message' => "State:\nbucket 2 holds A\nE also hashes to bucket 2\nstrategy: chaining\n\nWhere does E go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Onto bucket 2\'s list, after A', 'next' => 'ask_probe'],
                ['label' => 'Nowhere, because the bucket is taken', 'next' => 'w_rej'],
            ],
        ],
        'w_rej' => [
            'message' => "Wrong.\n\nWith chaining, both keys live in the list for bucket 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_a',
            'choices' => [],
        ],
        'ask_probe' => [
            'message' => "State:\nnow using open addressing instead\nslots = [ _, _, A, E ]\nA is deleted by emptying slot 2\nthen you look up E\n\nWhat is the bug?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The probe can stop at the empty slot and miss E', 'next' => 'success'],
                ['label' => 'There is no bug, because an empty slot always means it is safe to stop', 'next' => 'w_hole'],
            ],
        ],
        'w_hole' => [
            'message' => "Wrong.\n\nAn empty slot in the middle of a probe run looks like \"not found\". A tombstone tells the probe to keep going until it reaches E.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_probe',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- On a collision, chain the keys or probe for another slot.\n- Deletes with open addressing need tombstones.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
