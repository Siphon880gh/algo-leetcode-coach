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
            'message' => "State:\nsize = 2, capacity = 2\nappend 30\n\nWhat must happen first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Grow (for example to 4), copy, then write', 'next' => 'mid'],
                ['label' => 'Write at index 2 without growing', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe capacity is full, so the array has to grow first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nn appends, with the capacity doubling when full\n\nWhat is the amortized cost of each append?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'final'],
                ['label' => 'O(n) for every append', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThe occasional copies still average out to O(1) per append.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ninsert into the middle of a dynamic array of length n\n\nWhat does it cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), because elements shift', 'next' => 'success'],
                ['label' => 'O(1), because of the spare capacity', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFree slots at the end do not remove the shifting.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Double the capacity when an append finds it full.\n- Appends are amortized O(1).\n- Inserting in the middle is O(n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
