## Gcd test

1. `g = gcd(targetX, targetY)`.
2. Return whether `g & (g − 1) = 0`.

Examples → false, true. Checked against a search of every point up to 300 on each axis, for all targets below 40.

Run the moves backwards: from the target you may halve an even coordinate or add one coordinate to the other. When both are odd, adding and then halving shrinks the larger one, so any pair whose gcd is a power of two shrinks to (1, 1). An odd factor of the gcd can never be removed.

Time: O(log max)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
