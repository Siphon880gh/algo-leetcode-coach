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
            'message' => "Problem: 3 to 1e4 points, joined in order, form a simple polygon. Return true if it is convex. [[0,0],[0,5],[5,5],[5,0]] → true. [[0,0],[0,10],[10,10],[10,0],[5,5]] → false. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check the turn direction at every vertex with a cross product', 'next' => 's2'],
                ['label' => 'Compute each interior angle with atan2 and check < 180°', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Interior angles need atan2 and floating point, and checking each against 180° is slow and fragile. The sign of a cross product says the same thing with integers.\nStep back to when you computed angles.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cross of (B − A) and (C − A): positive left turn, negative right turn, zero collinear.\nWhich vertices do you check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i from 0 to n − 3, without wrapping', 'next' => 'wrong_b'],
                ['label' => 'All n, using indices i, (i + 1) % n, (i + 2) % n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The turns at the last two vertices use points 0 and 1 again. Skipping them can miss a dent near the start.\nStep back to when you stopped before wrapping.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Keep the last nonzero sign. Any later nonzero sign that differs → false. The polygon is simple, so same-direction turns everywhere means convex. O(n) time, O(1) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same nonzero sign everywhere, zeros ignored, wraparound included', 'next' => 'success'],
                ['label' => 'Return false on any zero cross product', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Collinear points have a zero cross product. They do not make the polygon concave.\nStep back to when you treated zero as a sign change.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Cross products at every vertex with wraparound, zeros ignored, one sign throughout. Square → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
