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
            'message' => "Problem: You are given paint, where paint[i] = [start_i, end_i] means on day i you paint the area between start_i and end_i (half-open: end excluded). Painting an already painted unit adds nothing. Return worklog, where worklog[i] is the amount of new area painted on day i. For instance, [[1,4],[4,7],[5,8]] → [3,3,1]; [[1,4],[5,8],[4,7]] → [3,3,1]; [[1,5],[2,4]] → [4,0]. (Restated from memory; limits and examples may differ slightly.)\nEach day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Jump to the next unpainted unit each time', 'next' => 's2'],
                ['label' => 'Scan every unit from start to end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Repainted stretches are scanned again on every day, which can be quadratic.\nStep back to when you scanned every unit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is end painted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, include end', 'next' => 'wrong_b'],
                ['label' => 'No: the area is half-open', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,4] covers 3 units, not 4.\nStep back to when you included end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Long chains of jumps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compress paths as you follow them', 'next' => 'success'],
                ['label' => 'Follow next pointers one at a time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without compression, chains over painted units can be walked again and again.\nStep back to when you skipped compression.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Near O(range + days). Constructed cases → [3,3,1], [3,3,1], [4,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
