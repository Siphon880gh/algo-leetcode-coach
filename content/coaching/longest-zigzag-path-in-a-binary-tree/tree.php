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
            'message' => "Read the problem statement above.\nGoing left after going right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'length + 1', 'next' => 's2'],
                ['label' => 'Restart at 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Alternating directions extend the zigzag.\nStep back to when you restarted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Going left after going left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart at 0', 'next' => 'wrong_b'],
                ['label' => 'Restart at 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The new path already has one edge.\nStep back to when you restarted at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Length counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Edges', 'next' => 'success'],
                ['label' => 'Nodes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single node has length 0.\nStep back to when you counted nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). First example → 3. Second → 4. [1] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
