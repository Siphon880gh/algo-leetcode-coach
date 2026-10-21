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
            'message' => "Read the problem statement above.\nStore a counter for each time unit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: times reach 10⁹; record only the endpoints', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That needs 10⁹ cells.\nStep back to when you counted every unit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does the running sum at a key mean?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The total length booked', 'next' => 'wrong_b'],
                ['label' => 'How many bookings cover that point', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. +1 and −1 at endpoints track coverage, not length.\nStep back to when you read it as length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "An interval ends at t and another starts at t. Do they overlap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: intervals are half-open', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [a, t) does not include t.\nStep back to when you counted them together.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) per booking with a sorted map. book(10,20) 1, book(50,60) 1, book(10,40) 2, book(5,15) 3, book(5,10) 3, book(25,55) 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
