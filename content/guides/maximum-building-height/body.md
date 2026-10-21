## Two sweeps, then peaks

1. Add `[1, 0]`; add `[n, n − 1]` if `n` is unrestricted; sort.
2. Left to right: `h[i] = min(h[i], h[i − 1] + (x[i] − x[i − 1]))`.
3. Right to left: `h[i] = min(h[i], h[i + 1] + (x[i + 1] − x[i]))`.
4. For each adjacent pair: `peak = (h1 + h2 + (x2 − x1)) // 2`; take the maximum.

Example 1 → 2. Example 2 → 5. Example 3 → 5.

A single sweep is not enough: a low limit on the right can lower earlier ones. n reaches 10^9, so never build the array.

Time: O(r log r)  
Space: O(r)

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
