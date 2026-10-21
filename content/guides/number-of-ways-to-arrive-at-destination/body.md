## Count while relaxing

1. `dist[0] = 0`, `ways[0] = 1`.
2. Pop `(d, u)`; skip stale entries. For each `(v, t)`: if `d + t < dist[v]`, set `dist[v]`, `ways[v] = ways[u]`, push; elif equal, `ways[v] += ways[u]` (mod).
3. Return `ways[n − 1]`.

Example 1 → 4. Example 2 → 1.

Distances reach about 2 · 10^11, so use 64-bit. Skipping stale heap entries prevents counting a node's ways twice.

Time: O(E log n)  
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
