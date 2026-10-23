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
            'message' => "Read the problem statement above.\nCount existing bulbs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, mark their ranges first', 'next' => 's2'],
                ['label' => 'No, start from a dark road', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 2 instead of 1.\nStep back to when you ignored the working bulbs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does the new bulb go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On the dark cell', 'next' => 'wrong_b'],
                ['label' => 'One step right of the dark cell', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): six dark positions → 3 instead of 2.\nStep back to when you placed it on the dark cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
