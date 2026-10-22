## Two downward values

1. For node `u`: `a` = best downward sum including the far end, `b` = excluding it; start `a = price[u]`, `b = 0`.
2. For each child with `(ca, cb)`: `best = max(best, a + cb, b + ca)`; then `a = max(a, ca + price[u])`, `b = max(b, cb + price[u])`.
3. Return `best`.

Examples → 24, 2. Checked against trying every root on 300 random trees.

Combining the current a with the child’s b, or the reverse, makes sure exactly one end is dropped. Use an explicit stack for paths up to 10^5 deep; sums reach about 10^10, so use 64-bit.

Time: O(n)  
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
