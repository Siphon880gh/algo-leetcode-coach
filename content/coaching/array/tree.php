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
            'message' => "State:\nscores = [72, 88, 91, 65, 80]\nneed = scores[2]\n\nCost class?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) — jump to base + 2 × size', 'next' => 'insert'],
                ['label' => 'O(n) — must walk from index 0', 'next' => 'w_walk'],
            ],
        ],
        'w_walk' => [
            'message' => "Wrong.\n\nContiguous layout makes index access address arithmetic, not a walk.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'insert' => [
            'message' => "State:\nscores = [72, 88, 91, 65, 80]\naction = insert 99 at index 2\n\nWhat must happen?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shift 91,65,80 right, then write 99 at index 2 — O(n)', 'next' => 'trap'],
                ['label' => 'Overwrite index 2 only — still O(1), no shifts', 'next' => 'w_over'],
            ],
        ],
        'w_over' => [
            'message' => "Wrong.\n\nOverwriting would drop 91. A true insert needs a hole, so the tail shifts.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'insert',
            'choices' => [],
        ],
        'trap' => [
            'message' => "State:\nclaim = \"arrays are always O(1) for every update\"\n\nWhat is wrong with that claim?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index reads are O(1); mid-insert/delete still shift — O(n)', 'next' => 'success'],
                ['label' => 'Nothing — every array write is O(1) including mid-insert', 'next' => 'w_claim'],
            ],
        ],
        'w_claim' => [
            'message' => "Wrong.\n\nFast index ≠ free mid-insert. Count the shifts.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'trap',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- `a[i]` is O(1)\n- Insert/delete at `k` shifts the tail — O(n)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
