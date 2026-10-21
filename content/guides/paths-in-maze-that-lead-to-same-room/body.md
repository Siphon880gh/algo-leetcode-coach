A maze has n rooms numbered 1 to n and a list of corridors, each connecting two different rooms in both directions (no duplicates). The confusion score is the number of different cycles of length 3, that is, sets of three rooms that are pairwise connected. Return it. For instance, n = 5 with corridors 1-2, 5-2, 4-1, 2-4, 3-1, 3-4 → 2; n = 4 with corridors 1-2, 3-4 → 0; four rooms all connected to each other → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count each triangle once

1. Build adjacency sets.
2. For each corridor `(a, b)`: add the number of `w` in `adj[a] ∩ adj[b]` with `w > max(a, b)`.

Constructed checks (verified against testing every triple of rooms on random graphs): the three cases above → 2, 0, 4.

A triangle `x < y < z` is counted only from its edge `(x, y)` with `w = z`. For large dense graphs, orienting each edge from lower to higher degree bounds the work by O(E · √E).

Time: O(E · d)  
Space: O(n + E)

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
