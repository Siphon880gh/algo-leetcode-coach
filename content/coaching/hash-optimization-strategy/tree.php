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
            'message' => "State:\nTwo Sum while scanning i left→right\n\nQuery before insert?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes — ask for target-nums[i], then insert nums[i]', 'next' => 'mid'],
                ['label' => 'No — insert first so a number can pair with itself always', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nUsually query first unless the problem allows using i twice.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ninner loop was scanning all prior indices\n\nReplace with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash map/set lookup', 'next' => 'final'],
                ['label' => 'Sorting every time inside the loop', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThe map turns “seen?” into expected O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn elements stored in the map\n\nExtra space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(1) always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nYou explicitly traded space for time.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Hash the repeated scan away\n- Expected O(n) time, O(n) space\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
