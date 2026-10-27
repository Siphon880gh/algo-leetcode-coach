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
            'message' => "State:\nyou want a level-order traversal\n\nWhich structure do you use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A queue', 'next' => 'mid'],
                ['label' => 'Only a stack', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBFS needs a queue.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\niterative preorder with a stack\n\nIn what order do you usually push the children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right, then left, so the left child pops first', 'next' => 'final'],
                ['label' => 'Left, then right, without thinking about it', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nA stack reverses the push order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\niterative postorder\n\nWhat is the hard part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Knowing whether a node still needs expanding or is ready to visit', 'next' => 'success'],
                ['label' => 'It is impossible without recursion', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nPhase marks make it possible.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Use a queue for BFS.\n- Use a stack with phase marks for the DFS orders.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
