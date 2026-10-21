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
            'message' => "Problem: Ships sit at integer points in a rectangle, and there are only a few of them. You can only ask whether a rectangle contains any ship, and the number of queries is limited. Return the number of ships in the given rectangle. (Restated from memory; limits and examples may differ slightly.)\nQuery each point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: split rectangles', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The area is huge and queries are limited.\nStep back to when you scanned points.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Quadrants share their border?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: use mid and mid + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A border ship would be counted twice.\nStep back to when you overlapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rectangle reports no ships?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0 without splitting', 'next' => 'success'],
                ['label' => 'Split anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pruning empty areas is the whole saving.\nStep back to when you split it anyway.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. About O(ships · log(side)) queries. For instance, three ships in the rectangle → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
