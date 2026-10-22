Given an integer array, count its subsequences whose sum is odd, modulo the value the statement gives. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Toggle one odd element

1. If no element is odd, return 0.
2. Return 2^(n − 1) mod the given modulus (fast power).

Constructed checks (run in code): [1, 3, 5] → 4; [2, 4] → 0; [1, 2] → 2. Checked against every subset on 200 random arrays.

Multiplying the odd count by 2^(even count): [1, 3, 5] → 3 instead of 4. A DP over (even, odd) counts also works in O(n).

Time: O(log n)  
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
