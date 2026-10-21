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
            'message' => "Read the problem statement above.\nWhat causes a triple booking?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The new interval overlapping a region already booked twice', 'next' => 's2'],
                ['label' => 'Overlapping any two bookings', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two bookings that do not overlap each other are fine to overlap separately.\nStep back to when you counted any two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The check passes. What do you add to the doubles list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole new interval', 'next' => 'wrong_b'],
                ['label' => 'The overlap with each existing booking', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the overlapping parts are now double-booked.\nStep back to when you added the whole interval.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In what order do you check and record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check doubles first, then record overlaps, then book', 'next' => 'success'],
                ['label' => 'Record overlaps, then check', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A rejected booking must leave no trace.\nStep back to when you recorded first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) per booking. book(10,20) true, book(50,60) true, book(10,40) true, book(5,15) false, book(5,10) true, book(25,55) true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
