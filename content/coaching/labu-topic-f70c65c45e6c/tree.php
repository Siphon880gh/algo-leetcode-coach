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
            'message' => "State:\nsubsets of [1, 1, 2]\neach subset should appear once\n\nWhat do you do first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort, so the equal 1s are next to each other', 'next' => 'mid'],
                ['label' => 'Never sort', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nSorting is what makes the neighbor skip rule work.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nat this depth, nums[i] == nums[i-1]\nand i-1 was not used at this depth\n\nWhat do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip i', 'next' => 'final'],
                ['label' => 'Take i anyway', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nSkipping i removes the duplicate branch.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou leave out the deduplication step\n\nWhat is the risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Duplicate subsets in the result', 'next' => 'success'],
                ['label' => 'Faster, still correct answers', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nDuplicate branches produce duplicate subsets.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Sort, then skip an equal neighbor that was not used.\n- Each result appears once.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
