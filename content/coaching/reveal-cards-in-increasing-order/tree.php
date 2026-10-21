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
            'message' => "Read the problem statement above.\nSearch for an order of the cards?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: simulate the process on positions', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The reveal order of positions does not depend on the values.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The front position of the queue is revealed. What card goes there?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The next largest card', 'next' => 'wrong_b'],
                ['label' => 'The next smallest card', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Cards must be revealed in increasing order.\nStep back to when you used the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After placing a card, what happens to the queue?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move the next position to the back', 'next' => 'success'],
                ['label' => 'Nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The rule moves the next top card to the bottom.\nStep back to when you skipped the move.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [17,13,11,2,3,5,7] → [2,13,3,11,5,17,7]. [1,1000] → [1,1000].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
