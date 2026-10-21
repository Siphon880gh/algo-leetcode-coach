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
            'message' => "Problem: Each building is [start, end, height] and covers the half-open interval [start, end) of a street. Describe the street as a minimal list of non-overlapping segments [left, right, average], where average is the total height of the buildings over that segment divided by their count using integer division, merging touching segments that share an average and leaving out stretches with no building, as the statement specifies. For instance, [[1,4,2],[3,9,4]] → [[1,3,2],[3,4,3],[4,9,4]] and [[1,2,1],[5,6,1]] → [[1,2,1],[5,6,1]]. (Restated from memory; limits and examples may differ slightly.)\nHow to find where averages change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Events at each start and end', 'next' => 's2'],
                ['label' => 'Mark every unit cell of the street', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Coordinates can be large; only the 2n endpoints can change anything.\nStep back to when you marked cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Value of a stretch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The tallest building', 'next' => 'wrong_b'],
                ['label' => 'Total height // building count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The segment value is the integer average, not the maximum.\nStep back to when you took the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Merge two stretches when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They touch and have the same average', 'next' => 'success'],
                ['label' => 'They have the same average', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[1,2,1],[5,6,1]] keeps two segments because of the gap.\nStep back to when you ignored gaps.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → [[1,3,2],[3,4,3],[4,9,4]], [[1,2,1],[5,6,1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
