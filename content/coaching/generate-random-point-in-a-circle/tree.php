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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pick the radius so area, not distance, is uniform', 'next' => 's2'],
                ['label' => 'Pick radius uniform in [0, r] and angle uniform in [0, 2π)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Uniform radius puts half the points within r / 2, which is only a quarter of the area. Points crowd the center.\nStep back to when you picked the radius uniformly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Area within ρ grows like ρ².\nHow do you pick ρ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ρ = r × u²', 'next' => 'wrong_b'],
                ['label' => 'ρ = r × sqrt(u), u uniform in [0, 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. u alone is the uniform-radius mistake again. u² pushes points even closer to the center.\nStep back to when you used u or u².",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Then x = x_c + ρ cos θ, y = y_c + ρ sin θ with θ uniform in [0, 2π). Rejection sampling from the square also works: retry until x² + y² <= r², about 1.27 tries on average.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sqrt for radius, uniform angle; or reject from the square. Not 470', 'next' => 'success'],
                ['label' => 'Pick x uniform in [−r, r], then y uniform within that chord', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Picking x uniformly and then y uniformly within that chord over-weights the left and right edges, where chords are short.\nStep back to when you sampled x then y on the chord.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Radius r × sqrt(u) with a uniform angle, or square rejection. Uniform over the area.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
