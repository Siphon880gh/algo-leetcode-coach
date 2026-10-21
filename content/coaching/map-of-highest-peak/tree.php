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
            'message' => "Read the problem statement above.\nBFS sources?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All water cells at once', 'next' => 's2'],
                ['label' => 'One BFS per water cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O((m · n)²) in the worst case.\nStep back to when you ran one BFS each.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Height of a land cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distance to the farthest water', 'next' => 'wrong_b'],
                ['label' => 'Distance to the nearest water', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Differences of at most 1 cap height by the nearest water.\nStep back to when you used the farthest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mark visited when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When first assigned', 'next' => 'success'],
                ['label' => 'When popped', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Late marking queues cells many times.\nStep back to when you marked on pop.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → [[1,0],[2,1]], [[1,1,0],[0,1,1],[1,2,2]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
