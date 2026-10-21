## Meeting point

1. `d1` = Dijkstra from `src1`; `d2` = from `src2`; `d3` = from `dest` on reversed edges.
2. Return `min(d1[m] + d2[m] + d3[m])` over all `m`, or −1 if infinite.

Examples → 9, −1. Checked against trying every edge subset on 150 small graphs.

An optimal subgraph is two paths that share a suffix once they meet; m = src1 or m = src2 covers one path running through the other source. Sums reach about 3 · 10^10, so use 64-bit.

Time: O((n + E) log n)  
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
