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
            'message' => "State:\ntwo O(n) solutions\none runs 8 times slower in benchmarks\n\nDoes that contradict Big-O?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. They are in the same class with different constants.', 'next' => 'mid'],
                ['label' => 'Yes. Big-O has to match the milliseconds.', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBig-O ignores constant factors, so two O(n) solutions can differ a lot in real time.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nn = 15 in a contest\n\nShould you always prefer O(n log n) over O(n²)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not always. Measure, because tiny inputs can favor simpler code.', 'next' => 'final'],
                ['label' => 'Yes. The lower class wins for every n.', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nAt small n, constants and simple code matter more than the growth class.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nscan n items stored in an array\nscan n items stored in a linked list\n\nWhich is usually faster in practice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The array, because it reads memory in order and uses the cache well', 'next' => 'success'],
                ['label' => 'The linked list, because following pointers is free on modern CPUs', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFollowing pointers jumps around memory. A contiguous scan uses the cache much better.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Use Big-O to reason about scaling.\n- Use benchmarks to compare constants.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
