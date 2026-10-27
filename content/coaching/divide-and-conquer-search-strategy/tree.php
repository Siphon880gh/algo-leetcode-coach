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
            'message' => "State:\na = [1, 3, 5, 7, 9]\ntarget = 7\nthe middle value is 5\n\nWhere do you search next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The right half', 'next' => 'mid'],
                ['label' => 'The left half', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\n7 is larger than 5, so the left half cannot contain it.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\neach step cuts the range in half\n\nWhat is the running time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(log n)', 'next' => 'final'],
                ['label' => 'O(n)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nHalving the range each time takes about log n steps.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou need the first occurrence of a key that appears several times\n\nIs a plain \"find any match\" search enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. Use a boundary binary search.', 'next' => 'success'],
                ['label' => 'Yes. Any matching index is always fine.', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFinding the first or last copy needs a search that keeps moving toward that edge.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Halve the range by testing the middle.\n- Keep the answer inside the range at every step.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
