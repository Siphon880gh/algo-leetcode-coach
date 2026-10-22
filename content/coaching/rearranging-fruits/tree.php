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
            'message' => "Read the problem statement above.\nWhich excess copies do you pay for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cheaper half of the sorted list', 'next' => 's2'],
                ['label' => 'Every copy in the list', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One swap moves two excess fruits; Example 1 → 3 instead of 1.\nStep back to when you paid for every copy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost of one swap of fruit x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x', 'next' => 'wrong_b'],
                ['label' => 'min(x, 2 · global minimum)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two swaps through the cheapest fruit can be cheaper; basket1 = [1,5,5,10,10], basket2 = [1,6,6,9,9] → 11 instead of 4.\nStep back to when you ignored the go-between.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
