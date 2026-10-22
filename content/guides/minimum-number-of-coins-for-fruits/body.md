## DP from the right (1-indexed)

1. For i = n down to 1: `f(i) = prices[i] + min(f(j) for j in i + 1 … 2i + 1)`, where j > n counts as 0.
2. Return f(1).

Examples → 4, 2, 39. Checked against trying every set of bought fruits on 500 random arrays.

Buying only fruits that are not yet free is not optimal: example 1 → 5 instead of 4. n ≤ 1000, so the O(n²) loop is fine; a monotonic queue makes it O(n).

Time: O(n²)  
Space: O(n)

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
