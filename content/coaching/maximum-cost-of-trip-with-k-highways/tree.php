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
            'message' => "Problem: There are n cities (n is small) and highways [city1, city2, toll] connecting pairs of cities in both directions. A trip starts at any city, crosses exactly k highways, and visits each city at most once. Return the maximum total toll of such a trip, or −1 if none exists. For instance, n = 5, highways [[0,1,4],[2,1,3],[1,4,11],[3,2,3],[3,4,2]], k = 3 → 17; n = 4, highways [[0,1,3],[2,3,2]], k = 2 → −1. (Restated from memory; limits and examples may differ slightly.)\nDP state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(visited mask, current city)', 'next' => 's2'],
                ['label' => '(steps taken, current city)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Without the mask a trip can go back and forth; the second constructed case → 6 instead of −1.\nStep back to when you dropped the mask.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Trip length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any length up to k', 'next' => 'wrong_b'],
                ['label' => 'Exactly k highways', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The second constructed case → 3 instead of −1.\nStep back to when you allowed shorter trips.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Start city?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every city', 'next' => 'success'],
                ['label' => 'City 0 only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The trip may start anywhere; n = 3, highways [[0,1,1],[1,2,5]], k = 1 → 1 instead of 5.\nStep back to when you fixed the start.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n · deg). Constructed cases → 17, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
