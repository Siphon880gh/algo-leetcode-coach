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
            'message' => "State:\nTwo Sum, scanning i from left to right\n\nDo you look up the partner before inserting nums[i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes. Look up target − nums[i], then insert nums[i].', 'next' => 'mid'],
                ['label' => 'No. Insert first, so a number can always pair with itself.', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nUsually you look up first, unless the problem lets you use the same index twice.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe inner loop was scanning every earlier index\n\nWhat replaces it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A lookup in a hash map or set', 'next' => 'final'],
                ['label' => 'Sorting the array again inside the loop', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThe map answers \"have I seen this?\" in expected O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn elements are stored in the map\n\nHow much extra space is used?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(1), always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nYou deliberately traded space for time.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Replace the repeated scan with a hash lookup.\n- It takes expected O(n) time and O(n) space.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
