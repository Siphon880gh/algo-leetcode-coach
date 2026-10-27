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
            'message' => "State:\nscores = [72, 88, 91, 65, 80]\nneed scores[2]\n\nHow much does this read cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1). Jump straight to base + 2 × size.', 'next' => 'insert'],
                ['label' => 'O(n). You must walk from index 0.', 'next' => 'w_walk'],
            ],
        ],
        'w_walk' => [
            'message' => "Wrong.\n\nIn a contiguous array, reaching an index is address arithmetic, not a walk.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'insert' => [
            'message' => "State:\nscores = [72, 88, 91, 65, 80]\naction: insert 99 at index 2\n\nWhat has to happen?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shift 91, 65 and 80 one slot right, then write 99 at index 2. That is O(n).', 'next' => 'trap'],
                ['label' => 'Overwrite index 2. It stays O(1) with no shifting.', 'next' => 'w_over'],
            ],
        ],
        'w_over' => [
            'message' => "Wrong.\n\nOverwriting would lose 91. A real insert needs an empty slot, so the tail has to shift.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'insert',
            'choices' => [],
        ],
        'trap' => [
            'message' => "State:\nclaim: \"every array update is O(1)\"\n\nWhat is wrong with that claim?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index reads are O(1), but inserting or deleting in the middle shifts elements, which is O(n)', 'next' => 'success'],
                ['label' => 'Nothing. Every array write is O(1), including inserting in the middle.', 'next' => 'w_claim'],
            ],
        ],
        'w_claim' => [
            'message' => "Wrong.\n\nFast index reads do not make middle inserts free. Count the shifts.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'trap',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Reading `a[i]` is O(1).\n- Inserting or deleting at index `k` shifts the tail, which is O(n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
