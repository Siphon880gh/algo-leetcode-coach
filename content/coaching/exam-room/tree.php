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
            'message' => "Read the problem statement above.\nWhich data structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A sorted list of occupied seats', 'next' => 's2'],
                ['label' => 'A boolean array of n seats', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n can be 10⁹.\nStep back to when you allocated n seats.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which seats are candidates in seat()?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the middles of gaps', 'next' => 'wrong_b'],
                ['label' => 'Seat 0, the middle of each gap, and seat n − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The ends can be farther from everyone.\nStep back to when you skipped the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two candidates tie. Which one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The lowest seat number', 'next' => 'success'],
                ['label' => 'The highest seat number', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for the lowest index.\nStep back to when you took the highest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k) per call with a sorted list. n = 10: seat → 0, seat → 9, seat → 4, seat → 2, leave(4), seat → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
