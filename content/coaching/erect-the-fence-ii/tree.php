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
            'message' => "Problem: Given the integer coordinates of trees, return the center x, y and radius r of the smallest circle that encloses all trees (points on the boundary count as inside); answers within a small tolerance are accepted, as the statement specifies. For instance, [[1,1],[2,2],[2,0],[2,4],[3,3],[4,2]] → [2.0, 2.0, 2.0], and [[1,2],[2,2],[4,2]] → [2.5, 2.0, 1.5]. (Restated from memory; limits and examples may differ slightly.)\nPoint outside the circle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rebuild with that point on the boundary', 'next' => 's2'],
                ['label' => 'Grow the radius to reach it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The centre must move too.\nStep back to when you only grew the radius.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Boundary points needed at most?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two', 'next' => 'wrong_b'],
                ['label' => 'Three', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Some circles are fixed only by three points.\nStep back to when you stopped at two.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Input order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shuffle first', 'next' => 'success'],
                ['label' => 'Keep as given', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adversarial order makes it cubic.\nStep back to when you skipped the shuffle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) expected. Constructed check → (2, 2, 2), (2.5, 2, 1.5).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
