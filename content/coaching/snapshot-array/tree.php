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
            'message' => "Read the problem statement above.\nCopy the array on each snap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: record changes per index', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(length) per snap.\nStep back to when you copied the array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two sets to one index before a snap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append both', 'next' => 'wrong_b'],
                ['label' => 'Overwrite the entry for the current snap_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the last value before the snap matters.\nStep back to when you appended both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "get(index, snap_id)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last entry with id ≤ snap_id, else 0', 'next' => 'success'],
                ['label' => 'Entry with id exactly snap_id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The index may not have changed in that snap.\nStep back to when you required an exact id.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log changes) per get. set(0,5), snap() → 0, set(0,6), get(0,0) → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
