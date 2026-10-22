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
            'message' => "Read the problem statement above.\nn up to 10^5: BFS from every house?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, O(1) pieces per house', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 10^10 steps.\nStep back to when you chose BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each piece adds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '+1 to each distance one by one', 'next' => 'wrong_b'],
                ['label' => '+1 over a range of distances, via a difference array', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That visits every pair again, about 10^10 steps.\nStep back to when you added one by one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [6, 0, 0], [10, 8, 2, 0, 0], [6, 4, 2, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
