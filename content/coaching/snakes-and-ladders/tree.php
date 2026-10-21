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
            'message' => "Read the problem statement above.\nWhich search gives the fewest moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS: every move costs 1', 'next' => 's2'],
                ['label' => 'DFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. DFS finds a path, not the shortest one.\nStep back to when you chose DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A ladder lands on the bottom of another ladder. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the second ladder too', 'next' => 'wrong_b'],
                ['label' => 'Stop: only one jump per move', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rules allow one snake or ladder per move.\nStep back to when you chained jumps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you find square s on the board?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r = (s − 1) // n from the bottom; reverse the column on odd r', 'next' => 'success'],
                ['label' => 'Row-major from the top', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Squares are numbered from the bottom in a zigzag.\nStep back to when you read row-major.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[-1,-1,-1,-1,-1,-1],[-1,-1,-1,-1,-1,-1],[-1,-1,-1,-1,-1,-1],[-1,35,-1,-1,13,-1],[-1,-1,-1,-1,-1,-1],[-1,15,-1,-1,-1,-1]] → 4. [[-1,-1],[-1,3]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
