## Pair sums

1. `p[i] = weights[i] + weights[i + 1]` for `i = 0 … n − 2`; sort.
2. Return `Σ` of the largest `k − 1` minus `Σ` of the smallest `k − 1`.

Examples → 4, 0. Checked against trying every split on 300 random arrays.

With k = 1 there are no cuts and the answer is 0. Sums reach about 2 · 10^14, so use 64-bit.

Time: O(n log n)  
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
